function latUcir(text) 
{ 
	var retValue = text;
	var latinica = new Array('dj','lj','nj','dž','Lj','Nj','Dž','a','b','v','g','d','đ','e','ž','z','i','j','k','l','m','n','o','p','r','s','t','ć','u','f','h','c','č','š','A','B','V','G','D','Đ','E','Ž','Z','I','J','K','L','M','N','O','P','R','S','T','Ć','U','F','H','C','Č','Š');	
	var cirilica = new Array ('ђ','љ','њ','џ','Љ','Њ','Џ','а','б','в','г','д','ђ','е','ж','з','и','ј','к','л','м','н','о','п','р','с','т','ћ','у','ф','х','ц','ч','ш','А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','М','Н','О','П','Р','С','Т','Ћ','У','Ф','Х','Ц','Ч','Ш');			
	for(i=0; i<cirilica.length; i++)
	{
		p = new RegExp(latinica[i], "g");
		retValue = retValue.replace(p, cirilica[i]);
	}
	return retValue;
} 
function latUcir_saLinkovima(str)
{
//neke promenljive se lose zovu jer su ostale od prvobitnih resenja 
//ima i mrtvog koda: prva verzija je vadila linkove prevodila tekst pa vrecala linkove, sto nije dobro.
	rimski = /\##[^\##]*\##/g;		//	sve uokvireno #
	var patt=/\<[^<]*>/g;	//svi HTML <tagovi>
	var nadjeni_linkovi=str.match(patt);//array linkova
	var nadjeni_rimski=str.match(rimski);//array rimskih 
	var sve='';
	if(nadjeni_linkovi || nadjeni_rimski)
	{
		pozicije=new Array() ;
		pozicije_rimski=new Array() ;
		var zaprevod=str;
		zbirne_pozicije=new Array() ;
		zbirno_nadjeno=new Array() ;
		if(nadjeni_linkovi)
		{	
			broj_linkova=nadjeni_linkovi.length;
			posl_nadjena_pozicija=0;
			for(var i=0;i<broj_linkova;i++)//za svaki link
			{
				pozicije[i]=str.indexOf(nadjeni_linkovi[i],posl_nadjena_pozicija);//sve pozicije linkova
				zaprevod=zaprevod.replace(nadjeni_linkovi[i],'');
				zbirno_nadjeno[i]=nadjeni_linkovi[i];
				zbirne_pozicije[i]=pozicije[i];
				posl_nadjena_pozicija=pozicije[i]+1;
			}
		}
		if(nadjeni_rimski)
		{
			broj_rimski=nadjeni_rimski.length;posl_nadjena_pozicija=0;
			for(var i=0;i<broj_rimski;i++)//za svaki link
			{
				pozicije_rimski[i]=str.indexOf(nadjeni_rimski[i],posl_nadjena_pozicija);//sve pozicije rimskih
				zaprevod=zaprevod.replace(nadjeni_rimski[i],'');//bez rimskih
				zbirno_nadjeno[i]=nadjeni_rimski[i];
				zbirne_pozicije[i]=pozicije_rimski[i];
				posl_nadjena_pozicija=pozicije_rimski[i]+1;
			}
		}	
		if(nadjeni_linkovi && nadjeni_rimski)
		{
			//sortiranje zbirnog niza - sve nadjeno stavi u jedan niz redja ih kako se ko pojavi
		    i = 0; j = 0; k = 0;  m = broj_rimski;  n =broj_linkova;
			while (i < broj_rimski && j < broj_linkova) 
			{
				if (pozicije_rimski[i] < pozicije[j]) 
				{
					zbirno_nadjeno[k] = nadjeni_rimski[i];
					zbirne_pozicije[k] = pozicije_rimski[i];
					i++;
				}
				else
				{
					zbirno_nadjeno[k] =nadjeni_linkovi[j];
					zbirne_pozicije[k] =pozicije[j];
					j++;
				}
				k++;
			}
			if (i < broj_rimski) 
			{
				for (var p = i; p < broj_rimski; p++) 
				{
					zbirno_nadjeno[k] = nadjeni_rimski[p];
					zbirne_pozicije[k] = pozicije_rimski[p];
					k++;
				}
			} 
			else 
			{
				for (var p = j; p < broj_linkova; p++) 
				{
					zbirno_nadjeno[k] =nadjeni_linkovi[p];
					zbirne_pozicije[k] =pozicije[p];
					k++;
				}
			}
		}				
		prevedeno='' ;//prevedi
		for(var j=0;j<zbirno_nadjeno.length;j++)
		{//h je deo cistog teksta za prevod
			if(j==0)
				var h=str.slice(0,zbirne_pozicije[j]);//na pocetku
			else 
				var h=str.slice(zbirne_pozicije[j-1]+zbirno_nadjeno[j-1].length,zbirne_pozicije[j]);
			prevedeno_h=latUcir(h) ;
			//var h2=prevedeno.slice(zbirne_pozicije[j]);
			var sve=prevedeno_h.concat(zbirno_nadjeno[j]); //spaja sa sl. nadjenim linkom
			prevedeno+=sve;
			if(j+1==zbirno_nadjeno.length)//na kraju
			{
				h=str.slice(zbirne_pozicije[j]+zbirno_nadjeno[j].length);//sve ostalo sto nije sporno
				prevedeno_h=latUcir(h) ;
				prevedeno+=prevedeno_h;
			}
		}
	}
	else
		prevedeno=latUcir(str);
	return prevedeno;
}	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
