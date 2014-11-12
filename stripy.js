
var tables = getElementsByClassName('stripy-table');

for( var  i = 0, ii =  tables.length; i < ii;  i++ )
{
	tbodyElem = tables[i].getElementsByTagName('tbody');
	
	for( var j = 0, jj = tbodyElem.length; j < jj; j++ )
	{
		rowElem = tbodyElem[j].getElementsByTagName('tr');
		
		for( var k = 1, kk = rowElem.length; k < kk; k += 2 )
		{
			rowElem[k].className = 'alt';
		}
	}
}

function getElementsByClassName(className) {

	//get all elements
	if( document.all )
	{
		var allElem = document.all;
	}
	else
	{
		var allElem = document.getElementsByTagName('*');
	}
	
	//array to store matched elements 
	var foundElem = [];
	
	for( var i = 0, ii = allElem.length; i < ii; i++ )
	{
		if( allElem[i].className == className)
		{
			foundElem[ foundElem.length ] = allElem[i];
		}
	}
	
	//return all matched elements
	return foundElem;
}