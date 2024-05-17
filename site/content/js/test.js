function filter_data(page)
{ 	
    
   
    
    var priceInputMax = document.getElementById('price-max'),
			priceInputMin = document.getElementById('price-min');
    var page=page;
    var x = priceInputMax.value;
    var y = priceInputMin.value;
    var sort=document.getElementById("input-select-sort").value;
    var show=document.getElementById("input-select-show").value;
    var test= document.getElementById("test").value;
    var id = document.getElementById("id").value;
    console.log(test,id,y,x,sort,show,page);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    var f=this.responseText;
    
    document.getElementById("row").innerHTML =f;
}
};
if(test=="all"){
    xmlhttp.open("GET", "index.php?action=produitList&filtre=price&min="+y+"&max="+x+"&sort="+sort+"&show="+show+"&page="+page, true);
    xmlhttp.send();
}else if(test=="surcategorie"){
    console.log("index.php?action=productCategorie&surcategorie="+id+"&filtre=price&min="+y+"&max="+x+"&sort="+sort+"&show="+show+"&page="+page);
	xmlhttp.open("GET", "index.php?action=productCategorie&surcategorie="+id+"&filtre=price&min="+y+"&max="+x+"&sort="+sort+"&show="+show+"&page="+page, true);
	xmlhttp.send();
}else if(test=="categorie"){
	xmlhttp.open("GET", "index.php?action=productCategorie&categorie="+id+"&filtre=price&min="+y+"&max="+x+"&sort="+sort+"&show="+show+"&page="+page, true);
	xmlhttp.send();
}else if(test=="souscategorie"){
	xmlhttp.open("GET", "index.php?action=productCategorie&souscategorie="+id+"&filtre=price&min="+y+"&max="+x+"&sort="+sort+"&show="+show+"&page="+page, true);
	xmlhttp.send();}
}


