function openn(x){
    if(document.getElementById('rm'+x).style.display == "none"){
        document.getElementById('rm'+x).style.display = "block";
        document.getElementById('rmm'+x).innerHTML = "Read Less";
    }else{
        document.getElementById('rm'+x).style.display = "none";
        document.getElementById('rmm'+x).innerHTML = "Read More";
    }
}


function test(){
    if(document.getElementById('popupContainer').style.display == 'none'){
        document.getElementById('popupContainer').style.display = 'flex';
    }else{
        document.getElementById('popupContainer').style.display = 'none'; 
    }
   
}
document.addEventListener('DOMContentLoaded', function() {
    var closeButton = document.querySelector('.close-button');
    var popupContainer = document.querySelector('.popup-container');
    
    closeButton.addEventListener('click', function() {
        popupContainer.style.display = 'none';
    });
    
    popupContainer.addEventListener('click', function(e) {
        if (e.target === this) {
            popupContainer.style.display = 'none';
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            popupContainer.style.display = 'none';
        }
    });
});