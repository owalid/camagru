// console.log(document.URL);
// var location = document.URL.split('/');
if (document.URL.split('/')[3] == 'modifUser' || document.URL.split('/')[3] == '?url=modifUser')
{
	var tab_photos = document.getElementById('tab_modif');
	var tab_enr = document.getElementById('tab_passwd');
	var tab_enr_content = document.getElementById('passwd');
	var tab_photos_content = document.getElementById('modif');
	
	tab_photos.addEventListener('click', photo_to_enr);
	tab_enr.addEventListener('click', enr_to_photo);
	
	function photo_to_enr(e) {
		tab_photos.classList.add('is-active');
		tab_enr.classList.remove('is-active');
		tab_enr_content.style.display = 'none';
		tab_photos_content.style.display = '';
	}
	
	function enr_to_photo(e) {
		tab_enr.classList.add('is-active');
		tab_photos.classList.remove('is-active');
		tab_enr_content.style.display = '';
		tab_photos_content.style.display = 'none';
	}
}