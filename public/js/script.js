document.addEventListener('DOMContentLoaded', function () {
    var splide1 = new Splide('#splide1',{
        type : 'loop',
        autoplay : true
    });
    splide1.mount();

    var splide2 = new Splide('#splide2',{
        perPage: 4,
        gap: '2rem',
        type : 'loop',
        autopaly : true,
        breakpoints:{

        640:{
            perPage: 2,
            gap: '1rem'
        },

        480:{
            perPage: 2,
            gap: '1rem'
        }
    }
    });

    var bar = splide2.root.querySelector( '.my-slider-progress-bar' );
  
  // Updates the bar width whenever the carousel moves:
    splide2.on( 'mounted move', function () {
      var end  = splide2.Components.Controller.getEnd() + 1;
      var rate = Math.min( ( splide2.index + 1 ) / end, 1 );
      bar.style.width = String( 100 * rate ) + '%';
    } );
    splide2.mount();
});

let isOn = false;

const menu = document.querySelector('.menu');
const li = document.querySelectorAll(".menu-item");
const menuBtn = document.querySelector('.menuBtn');
const controlles = document.querySelector('.controlles');

menuBtn.addEventListener('click', () => {
    console.log(controlles);
    if (isOn) {
        controlles.style.display = "none";
        isOn = false;
    } else {
        controlles.style.display = "flex";
        isOn = true;
    }
})

menu.addEventListener('mouseenter', () => {
    menu.style.display = "flex";
})

menu.addEventListener('mouseleave', () => {
    menu.style.display = "none";
});

li.forEach(item => {
    item.addEventListener('mouseenter', () => {
        renderMenu(item.innerText);
        menu.style.display = "flex";
    })

    item.addEventListener('mouseleave', () => {
        renderMenu(item.innerText);
        menu.style.display = "none";
    })
})

function renderMenu(item) {
    console.log(item);
    if (item === "MEAG MENU") {
        menu.innerHTML = `<div class="menu-warpper">
                            <div class="menu-section">
                                <h4>Focus on</h4>
                                <div class="picture">
                                    
                                        <img src="http://127.0.0.1:8000/images/demo1.png">
                                        <div class="plus-icon">+</div>
                                </div>
                                <p>
                                    Consed quodips ameniat empernam que apid cust quas molor eatis numa estio.
                                </p>
                                <button>View project</button>
                            </div>
                            <div class="menu-section">
                                <h4>Special pages</h4>
                                <ul>
                                    <li><a href="#">3 Columns Details Grid Portfolio</a></li>
                                    <li><a href="#">Fullscreen Grid Portfolio</a></li>
                                    <li><a href="#">Portfolio Post with Video</a></li>
                                    <li><a href="#">2 Columns Grid Blog with Left Sidebar</a></li>
                                    <li><a href="#">3 Columns Grid Blog without Sidebar</a></li>
                                    <li><a href="#">Blog Post with Right Sidebar</a></li>
                                    <li><a href="#">Side Navigation Page</a></li>
                                    <li><a href="#">About Page II</a></li>
                                    <li><a href="#">Service Page I</a></li>
                                    <li><a href="#">Pricing Page I</a></li>
                                    <li><a href="#">Contact Page I</a></li>
                                </ul>
                            </div>
                            <div class="menu-section">
                                <h4>Latest works</h4>
                                <div class="latest-work">
                                    <div class="row">
                                        <div class="work"><img src="http://127.0.0.1:8000/images/demo1.png"><div class="plus-icon">+</div></div>
                                        <div class="work"><img src="http://127.0.0.1:8000/images/demo1.png"><div class="plus-icon">+</div></div>
                                        <div class="work"><img src="http://127.0.0.1:8000/images/demo1.png"><div class="plus-icon">+</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="work"><img src="http://127.0.0.1:8000/images/demo1.png"><div class="plus-icon">+</div></div>
                                        <div class="work"><img src="http://127.0.0.1:8000/images/demo1.png"><div class="plus-icon">+</div></div>
                                        <div class="work"><img src="http://127.0.0.1:8000/images/demo1.png"><div class="plus-icon">+</div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-section">
                                <h4>About us</h4>
                                <p>Voluptat ibusaped molorporro consequ idustibus. Reressi morum ut dolessiti tem nihicid
                                ernatum, coria volore non pro officat ut autem accaborem conet. Omnis peribus qui dolent
                                praeperrum coria.</p>
                                <p>Equam conesti occum dolorest, quae venderes quistius, comnitatur sae dinam nonseculpa
                                cum fugit is verciam.</p>
                                <button>read more</button>
                            </div>
                        </div>`;
    } else if (item === "HOME") {
        menu.innerHTML = `<div class="menu-warpper">
                            <div class="menu-section"><h4>Home Page</h4></div></div>`;
    } else if (item === "PORTFOLIO") {
        menu.innerHTML = `<div class="menu-warpper">
                            <div class="menu-section"><h4>PORTFOLIO</h4></div></div>`;
    } else if (item === "BLOG") {
        menu.innerHTML = `<div class="menu-warpper">
                            <div class="menu-section"><h4>BLOG</h4></div></div>`;
    } else if (item === "PAGES") {
        menu.innerHTML = `<div class="menu-warpper">
                            <div class="menu-section"><h4>PAGES</h4></div></div>`;
    } else if (item === "FEATURES") {
        menu.innerHTML = `<div class="menu-warpper">
                            <div class="menu-section"><h4>FEATURES</h4></div></div>`;
    } else if (item === "CONTACT") {
        menu.innerHTML = `<div class="menu-warpper">
                            <div class="menu-section"><h4>CONTACT</h4></div></div>`;

    }
}

// subscribe
function subscribe() {
    let email = document.getElementById("email").value;
    let subBtn = document.getElementById("subBtn");
    let warpInput = document.querySelector(".warp-input");

    // email validation
    if (email == "") {
        warpInput.style.boxShadow = "0 0 3px 5px red";
    } else {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        if (pattern.test(email)) {
            subBtn.innerText = "THANK YOU";
            warpInput.style.boxShadow = "0 0 3px 5px #60ff5a";
        } else {
            warpInput.style.boxShadow = "0 0 3px 5px red";
        }
    }

}

function closeMsgBox(){
    let msgBox = document.querySelector(".message-box");
    msgBox.style.display = "none";
}