document.addEventListener('DOMContentLoaded', () => {
    const userBtn = document.getElementById('user-btn1');
    const profileDetail = document.querySelector('.profile-detail');

    userBtn.addEventListener('click', () => {
        if (profileDetail.style.display === 'none' || profileDetail.style.display === '') {
            profileDetail.style.display = 'block';
        } else {
            profileDetail.style.display = 'none';
        }
    });
});












// const userBtn1 = document.getElementById('user-btn1')
// // document.querySelector('.bx .bxs-user');
// userBtn1.addEventListener('click', function(){
//         const userBox = document.querySelector('.profile-detail');
//         userBox.classList.toggle('active');

   
// })


// let profile = document.querySelector('.header .flex .profile-detail');
// let searchForm = document.querySelector('.header .flex .search-form');
// let navbar = document.querySelector('.navbar');


//     document.querySelector('#search-btn').onclick = () => {
//     searchForm.classList.toggle('active');
//     profile.classList.remove('active');
// }

// document.querySelector('#menu-btn').onclick = () => {
//     navbar.classList.toggle('active');
// }
    

/* ----------home slider---------- */
    const imgBox = document.querySelector('.slider-container');
    const slides = document.getElementsByClassName('slideBox');
    let i = 0;

    function nextSlide() {
        slides[i].classList.remove('active');
        i = (i + 1)% slides.length;
        slides[i].classList.add('active');
    }

    function prevSlide() {
        slides[i].classList.remove('active');
        i = (i - 1 + slides.length) % slides.length;
        slides[i].classList.add('active');
    }

    // document.addEventListener('DOMContentLoaded', function() {
    //     const menuBtn = document.getElementById('menu-btn');
    //     const searchBtn = document.getElementById('search-btn');
    //     const profileBtn = document.getElementById('user-btn1');
    //     const searchForm = document.querySelector('.search-form');
    //     const profileDetail = document.querySelector('.profile-detail');
    
    //     menuBtn.addEventListener('click', () => {
    //         // Toggle the visibility of the navbar menu
    //         const navbar = document.querySelector('.navbar');
    //         navbar.classList.toggle('active');
    //     });
    
    //     searchBtn.addEventListener('click', () => {
    //         // Toggle the visibility of the search form
    //         searchForm.classList.toggle('active');
    //     });
    
    //     profileBtn.addEventListener('click', () => {
    //         // Toggle the visibility of the profile details
    //         profileDetail.classList.toggle('active');
    //     });
    // });
    
































/* ----------testimonial---------- */

// const btn = document.getElementsByClassName('btn1'); // Corrected method name
// const slide = document.getElementById('slide'); // Corrected object name

// btn[0].onclick = function () {
//     slide.style.transform = 'translateX(0px)';
//     for (var i = 0; i < btn.length; i++) { // Changed to btn.length to avoid hardcoding the length
//         btn[i].classList.remove('active');
//     }
//     this.classList.add('active');
// }

// btn[1].onclick = function () {
//     slide.style.transform = 'translateX(-800px)';
//     for (var i = 0; i < btn.length; i++) { // Changed to btn.length to avoid hardcoding the length
//         btn[i].classList.remove('active');
//     }
//     this.classList.add('active');
// }

// btn[2].onclick = function () {
//     slide.style.transform = 'translateX(-1600px)';
//     for (var i = 0; i < btn.length; i++) { // Changed to btn.length to avoid hardcoding the length
//         btn[i].classList.remove('active');
//     }
//     this.classList.add('active');
// }

// btn[3].onclick = function () {
//     slide.style.transform = 'translateX(-2400px)';
//     for (var i = 0; i < btn.length; i++) { // Changed to btn.length to avoid hardcoding the length
//         btn[i].classList.remove('active');
//     }
//     this.classList.add('active');
// }




