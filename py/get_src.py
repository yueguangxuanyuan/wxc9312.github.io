import requests
import bs4
from multiprocessing import Pool
import urllib

site_address = "http://wow.blizzgame.ru"

def getPageLinks( pageid ):
	links = []
	response = requests.get(site_address+"/gallery/?start="+str(pageid * 20))
	if response.status_code == 200:
		soup = bs4.BeautifulSoup(response.text,"html.parser");
		links = [a.attrs.get('href') for a in soup.select("div.gallery-section ul.gallery-list li a[href^=/gallery]")]
	return links

def getPictureSrc(url):
	return url.replace("gallery","assets/Warcraft-Gallery")+".jpg"

links = []

def func(pid):
	print("start get links on Pid"+str(pid))
	links = [getPictureSrc(url) for url in getPageLinks(pid)]
	file = open("/home/I309994/war/"+str(pid)+".txt","w")
	file.writelines([alink+"\n" for alink in links])
	file.close()
	print("complete get links on Pid"+str(pid))

Pool(8).map(func,range(1,100));
	
