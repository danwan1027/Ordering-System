function show_hide_password(){
    var x = document.getElementById('passwordfield');
    if(x.type === 'password'){
        x.type = 'text';
    }
    else{
        x.type = 'password';
    }
}
function show_hide_confirm_password(){
    var x = document.getElementById('password-confirm');
    if(x.type === 'password'){
        x.type = 'text';
    }
    else{
        x.type = 'password';
    }
}

function check_cart(meal){
    if(submit_sure_cart() && isCheckBoxChoose_cart(meal)){
        return true;
    }
    return false;
}

function submit_sure_cart(){  
    return confirm('確認送出訂單？');
}  

function isCheckBoxChoose_cart(meal){
    var obj = document.getElementsByName(meal);
    var objLen = obj.length;
    var objYN = false;
    var count = 0;
    for(var i = 0 ; i < obj.length; i++){
        if(obj[i].checked == true){
            objYN = true;                   
            count++;
        }
    }

    if(count > 8){
        alert('最多選擇8項');
        return false;
    }

    if(objYN == false){
        alert('請至少選擇一項');
        return false;
    }
    return true;
}

var totalPrice_cart = 0;
function isCheck(id, price){
    var checkbox = document.getElementById(id);
    if(checkbox.checked == false){
        totalPrice_cart -= price;
        document.getElementById('totalPrice_cart').innerHTML = "總金額："+ totalPrice_cart + "元";
        return;
    }
    else{
        totalPrice_cart += price;
        document.getElementById('totalPrice_cart').innerHTML = "總金額：" + totalPrice_cart + "元";
        return;
    }

}


function submit_sure_index(){  
    return confirm('確認加入購物車？');
}  


//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

