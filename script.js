const btnAddYoutube = document.getElementById("add-youtube");
const containerInputYoutube = document.getElementById("inputs-youtube");

btnAddYoutube.addEventListener("click",function (){
    const textAreaElement = document.createElement("textarea");

    textAreaElement.name = "youtube[]";
    containerInputYoutube.appendChild(textAreaElement);

})

