// import file
window.onload = () => {

	var formRegister = document.getElementById('formRegister');
	var input_file = document.querySelector('#import_file');
	var	publish = document.getElementById('publi');
	var name = document.querySelector('#file_name');
	var name2 = document.querySelector('#file_name2');
	var trash = document.getElementById('trash');
	input_file.addEventListener('change', handleFiles);
	trash.addEventListener('click', delete_files);
	formRegister.addEventListener('submit', prepareImg);

function handleFiles(e) {
	file = e.target.files[0];
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	var blank = document.getElementById('blank');
	if (canvas.toDataURL() !== blank.toDataURL())
		ctx.clearRect(0, 0, canvas.width, canvas.height);
    var img = new Image;
    img.src = URL.createObjectURL(file);
    img.onload = function() {
		filter.style.display = '';
		name.innerText = file.name;
		name2.innerText = file.name;
		publish.disabled = false;
		ctx.drawImage(img, 0, 0, img.width, img.height);
	}
}
function prepareImg() {
	var canvas = document.getElementById('canvas');
	var blank = document.getElementById('blank');

	if (canvas.toDataURL() !== blank.toDataURL())
		{
		document.getElementById('inp_img').value = canvas.toDataURL();
		}
	}
function delete_files(e)
{
	var filter = document.getElementById('filter');
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	// var blank = document.getElementById('blank');
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	name.innerText = "Aucune image importée";
	name2.innerText = "Aucune image";
	publish.disabled = true;
	filter.style.display = 'none';
}
}

// take picture
(function() {
	var streaming = false,
		video        = document.querySelector('#video'),
		cover        = document.querySelector('#cover'),
		canvas       = document.querySelector('#canvas'),
		startbutton  = document.querySelector('#take_pic'),
		width = 1280,
		height = 720;

	var name = document.getElementById('file_name');
	var name2 = document.getElementById('file_name2');
	var blank = document.getElementById('blank');
	var	publish = document.getElementById('publi');
	var ctx = canvas.getContext('2d');
	var constraints = { audio: false, video: { width: 1280, height: 720 } }; 

	navigator.mediaDevices.getUserMedia(constraints)
	.then(function(mediaStream) {
		startbutton.disabled = false;
	var video = document.querySelector('video');
	video.srcObject = mediaStream;
	video.onloadedmetadata = function(e) {
		video.play();
	};
	})
	.catch(function(err) {
		startbutton.disabled = true;
	});
	video.addEventListener('canplay', function(ev){
	if (!streaming) {
		height = video.videoHeight / (video.videoWidth/width);
		video.setAttribute('width', width);
		video.setAttribute('height', height);
		canvas.setAttribute('width', width);
		canvas.setAttribute('height', height);
		streaming = true;
	}
	}, false);

	function takepicture() {
		if (canvas.toDataURL() !== blank.toDataURL())
		{
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		name.innerText = "Aucune image importée";
		name2.innerText = "Aucune image";
		}
		var currentDate = new Date();
		canvas.width = width;
		canvas.height = height;
		name2.innerText =  currentDate.getTime() + ".jpg";
		publish.disabled = false;
		filter.style.display = '';
		ctx.drawImage(video, 0, 0, width, height);
	}

	startbutton.addEventListener('click', function(ev){
		takepicture();
	ev.preventDefault();
	}, false);

})();

