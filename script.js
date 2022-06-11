const btnAddYoutube = document.getElementById("add-youtube");
const containerInputYoutube = document.getElementById("inputs-youtube");
const btnsDelete = document.querySelectorAll(".btn-delete");
const deleteVideo = function (event)
{
    event.target.parentElement.remove("youtubeContent");
}


btnAddYoutube.addEventListener("click",function (){
    const textAreaElement = document.createElement("textarea");
    textAreaElement.classList.add(("youtubeContent"));
    textAreaElement.name = "youtube[]";

    const btnDelete = document.createElement("button");
    btnDelete.innerText = "supprimer";
    btnDelete.addEventListener("click", deleteVideo);

    const container = document.createElement("div");
    container.appendChild(textAreaElement);
    container.appendChild(btnDelete);


    containerInputYoutube.appendChild(container);

})

for (const btnsDeleteElement of btnsDelete) {
    btnsDeleteElement.addEventListener("click", deleteVideo);
}






