
function showInput() {
    let inputBox = document.querySelector('.input-box');
    inputBox.style.display = "flex";
}


function cancel() {
    let inputBox = document.querySelector('.input-box');
    inputBox.style.display = "none";
}

function showUpdateForm(id, title, caption, btnText, btnUrl, imagePath) {
    let updateForm = document.querySelector(`.update-form`);
    let updateWrapper = document.querySelector(`.update-wrapper`);
    // console.log(id);

    let container = updateForm.closest('[wire\\:id]');
    let componentId = container.getAttribute('wire:id');
    let component = Livewire.find(componentId);

    
    component.set('uid', id);
    component.set('title', title);
    component.set('caption',caption);
    component.set('btnText',btnText);
    component.set('btnUrl',btnUrl);

    document.getElementById("hero-image").src = `http://127.0.0.1:8000/storage/${imagePath}`;

    updateForm.style.display = 'flex';
}

function showPortfolioUpdateForm(id, title, category, isActive, imagePath) {
    let updateForm = document.querySelector(`.update-form`);
    let updateWrapper = document.querySelector(`.update-wrapper`);
    // console.log(id);

    let container = updateForm.closest('[wire\\:id]');
    let componentId = container.getAttribute('wire:id');
    let component = Livewire.find(componentId);

    
    component.set('uid', id);
    component.set('title', title);
    component.set('category', category);
    
    if(isActive == "1"){
        component.set('isActive', "true");
    }else{
        component.set('isActive', "false");
    }

    document.getElementById("portfolio-image").src = `http://127.0.0.1:8000/storage/${imagePath}`;

    updateForm.style.display = 'flex';
}


function showFeatureUpdateForm(id, title, caption, icon) {
    let updateForm = document.querySelector(`.update-form`);
    let updateWrapper = document.querySelector(`.update-wrapper`);
    // console.log(id);

    let container = updateForm.closest('[wire\\:id]');
    let componentId = container.getAttribute('wire:id');
    let component = Livewire.find(componentId);

    
    component.set('uid', id);
    component.set('title', title);
    component.set('caption',caption);
    component.set('icon',icon);

    updateForm.style.display = 'flex';
}

function showPageUpdateForm(id, title, caption, slug, btnText, btnUrl) {
    let updateForm = document.querySelector(`.update-form`);
    let updateWrapper = document.querySelector(`.update-wrapper`);
    // console.log(id);

    let container = updateForm.closest('[wire\\:id]');
    let componentId = container.getAttribute('wire:id');
    let component = Livewire.find(componentId);

    
    component.set('uid', id);
    component.set('title', title);
    component.set('caption',caption);
    component.set('slug',slug);
    component.set('btnText',btnText);
    component.set('btnUrl',btnUrl);
    

    updateForm.style.display = 'flex';
}

function cancelUpdate() {
    let updateForm = document.querySelector(`.update-form`);
    updateForm.style.display = 'none';
}

function closeMsg(){
    msgBox = document.querySelector('.msg-box');
    msgBox.style.display = "none";
}