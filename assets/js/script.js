// ambil elemen
// keyword and search in topbar
var keyword = document.getElementById('keyword');
var search = document.getElementById('search');
// portfolio-grid in index
var container = document.getElementById('portfolio-grid');

keyword.addEventListener('keyup', function(){
	// buat objek ajax
	var xhr = new XMLHttpRequest();
	// cek kesiapan ajax
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			container.innerHTML = xhr.responseText;
		}
	}
	// eksekusi ajax
	// true = asyncronous
	xhr.open('GET', 'assets/ajax/book.php', true);
	xhr.send();
});