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

var inputid = ["input1","input2","input3","input4","input5","input6","input7","input8","input9","input10","input11","input12"];
var price = [30,40,50,55];
var outputs = document.getElementsByClassName("output");
for(let i=0;i<outputs.length;i++){
    outputs[i].setAttribute('hidden','hidden');
}
var qty = document.getElementsByClassName("quantity");
var prc = document.getElementsByClassName("price");
function outputRealtime(index){
    let input = document.getElementById(inputid[index]);
    let result = input.value * price[index % 4];
    if(input.value > 0){
        outputs[index].removeAttribute('hidden');
    }
    else if(input.value == 0){
        outputs[index].setAttribute('hidden','hidden');
    }
    prc[index].innerHTML = result;
    qty[index].innerHTML = input.value;
}