function newQuote(){
    setTimeout(function(){
        window.location.reload(true);

    }, 20000);  //Reload page to select new quote after 20 seconds
    

}

function randomBgColor() {

    var colors = ["Red","Yellow","Green","Maroon","Purple","Teal","Pink","Blue","Orange"]; //List of colors to pick for background
    var colorCount = colors.length;  //Find amount of colors in case we add more later
    var colorPicker = Math.floor(Math.random() * colorCount);  //Pick random color

    document.body.style.backgroundColor = colors[colorPicker];  

    
}


function start() {    //functions to run on page load
    newQuote();
    randomBgColor();


}