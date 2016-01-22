import requests
import bs4
from multiprocessing import Pool
import urllib

site_address = "http://wow.blizzgame.ru"

def getPageLinks( pageid ):
	links = []
	response = requests.get(site_address+"/gallery/?start="+str(pageid))
	if response.status_code == 200:
		soup = bs4.BeautifulSoup(response.text);
		links = [a.attrs.get('href') for a in soup.select("div.gallery-section ul.gallery-list li a[href^=/gallery]")]
	return links

def getPictureSrc(url):
	return url.replace("gallery","assets/Warcraft-Gallery")+".jpg"

def getPic(url):
	print (site_address + url)
	urllib.request.urlretrieve(site_address+url,"/home/I309994"+url)

links = []


for pid in range(10000,10160):
	links = [getPictureSrc(url) for url in getPageLinks(pid)]
	pool = Pool(8);	
	pool.map(getPic,links);



