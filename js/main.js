function logSection(){

    let logScreenActivator = document.querySelector('.menu-log-section');
    let logScreen = document.querySelector('.log-form-section');
    let logStatus = document.querySelector('.log-status');

    let content = document.querySelector('.content');

    let isOpen = false;

    logScreenActivator.addEventListener('click',function(){
        if(logStatus.innerHTML == 'zaloguj'){
            showLoginSection();
        }
        else{
            if(sessionStorage.getItem('isAdmin') == 'true'){
                window.location = 'adminPanel.php';
            }
            else{
                window.location = 'userPanel.php';
            }
        }
    });

    // logClose.addEventListener('click',function(){
    //     logSectionClose();
    // });

    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode == 27) {
            logSectionClose();
        }
    };

    if(incorrectPassword){

        showLoginSection();
        document.querySelector('.login-failed-alert').style.opacity = '1';

    }
        

    function logSectionClose(){
        if(isOpen){
            content.style.filter = 'blur(0)';
    
            logScreen.style.opacity = '0';
            window.setTimeout(function(){
                logScreen.style.visibility = 'hidden';
            },1000);
    
            isOpen = false;
            incorrectPassword = false;
        }
    }
    function showLoginSection(){
        content.style.filter = 'blur(3px)';

            logScreen.style.visibility = 'visible';
            logScreen.style.opacity = '1';
            isOpen = true;
    }

    console.log('logSection done');
}
logSection();

function inputFillDetect(){
    let input = document.getElementsByTagName('input');
    
    for(let i = 0; i < input.length;i++){
        input[i].addEventListener('input',function(){
            if(input[i].value != ''){
                input[i].classList.add('fill');
            }
            else{
                input[i].classList.remove('fill');
            }
        });
    }
}
inputFillDetect();