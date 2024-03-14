var coll = document.getElementsByClassName("collaps");
var contents = document.getElementsByClassName("content");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        // this.classList.toggle("active");
        for(let j=0;j<contents.length;j++){
            if(j === i){
                if (contents[j].style.display === "block") {
                    contents[j].style.display = "none";
                } else {
                    contents[j].style.display = "block";
                }
                coll[j].classList.toggle("active");
            }
            else if (contents[j].style.display === "block"){
                contents[j].style.display = "none";
                coll[j].classList.toggle("active");
            }
        }
    });
}