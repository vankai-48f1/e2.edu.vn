// video
var firstImageUrl = document.querySelector('.item-video').dataset.img;
firstNumber = document.querySelector('.item-video').dataset.number;
firstTitle = document.querySelector('.video-content h3').textContent;
firstDate = document.querySelector('.video-content p').textContent;
// playIcon = document.querySelector('.item-video.active .number-order').innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';


document.querySelector('.item-video').classList.add("active");
document.getElementById("show-video").src = 'https://www.youtube.com/embed/' + firstImageUrl;
document.querySelector('.single-video-title').innerHTML = firstTitle;
document.querySelector('.item-single-date').innerHTML = firstDate;

// if(!document.getElementById('show-video').playing){
//     document.querySelector('.item-video').classList.add("active-play");
// }else {
//     document.querySelector('.item-video').classList.add("active-pause");
// }

var listVideos = document.querySelectorAll('.item-video');
var imageUrls = document.querySelectorAll('.item-video');
var i = 0;
imageUrls.forEach(imageUrl => {
    i++;
    imageUrl.addEventListener('click', function (e) {
        var valueIframe = this.dataset.img;
        var valuenumber = this.dataset.number;
        var valueTitle = this.querySelector('.video-content h3').textContent;
        var valueDate = this.querySelector('.video-content p').textContent;

        document.getElementById("show-video").src = 'https://www.youtube.com/embed/' + valueIframe + '?autoplay=1';
        document.querySelector('.single-video-title').innerHTML = valueTitle;
        document.querySelector('.item-single-date').innerHTML = valueDate;

        listVideos.forEach(item => {
            item.classList.remove('active');
        });
        this.classList.add("active");
    });
});
// document.querySelector('.tab-total .num-total').innerHTML = i;