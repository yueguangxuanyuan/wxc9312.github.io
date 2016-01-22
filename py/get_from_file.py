from multiprocessing import Pool
import urllib

site_address = "http://wow.blizzgame.ru"

def getPageLinks( pageid ):
	file = open("/war/"+str(pageid)+".txt","r")
	links = file.readlines()
	return links

def getPic(url):
	print (site_address + url)
	urllib.urlretrieve(site_address+url,"/"+url)

links = []


for pid in range(1,100):
	links = getPageLinks(pid)
	pool = Pool(8);	
	pool.map(getPic,links);




