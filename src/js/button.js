if (document.getElementById("deconnexion")) {
    document.getElementById("deconnexion").addEventListener("click", function(){
        window.location.href = "../backend/logout.php";
    });
}else {
    document.getElementById("login").addEventListener("click", function(){
        window.location.href = "./pages/login.php";
    });
    
    document.getElementById("register").addEventListener("click", function(){
        window.location.href = "./pages/register.php";
    });
}