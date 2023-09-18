var var_x3 = [];
var pause3 = 0; // déclare si il y a pause de translation
var pausex3; // sert aux calculs de x pour les déplacements
var canvas3 = document.getElementById("canvas3");
var ctx3 = canvas3.getContext("2d");
const container3 = canvas3.getBoundingClientRect();
var deplacement3 = 0; // évite les clicks intempestives lors du déplacement
var images3 = canvas3.getElementsByTagName('img');
var nb_images3 = images3.length - 1 ; // nombre d'image - 1

for(i3=0;i3<=nb_images3;i3++){ // on déclare les positions d'origine
        var_x3[i3] = i3 * 160;
}

window.onload = function() { // on affiche tout
        for(i3=0;i3<=nb_images3;i3++){
                ctx3.drawImage(images3[i3], var_x3[i3], 0, 150, canvas3.height);
        }
};

function coulissement_auto3(){
        ctx3.clearRect(0, 0, canvas3.width, canvas3.height) // on efface le canvas
        for(i3=0;i3<=nb_images3;i3++){
                var_x3[i3]-=1; // on décrémente tout
        }   
        for(i3=0;i3<=nb_images3;i3++){
                ctx3.drawImage(images3[i3], var_x3[i3], 0, 150, canvas3.height); // on réintroduit les images3 après les décrémentations
        }
        if(var_x3[0]==-150){var_x3[0]=(var_x3[nb_images3]+160)}  // on teste si l'image le plus à gauche sort du canvas
        for(i3=1;i3<=nb_images3;i3++){
                if(var_x3[i3]==-150){var_x3[i3]=(var_x3[i3-1]+160)}
        } 
}

function coulissement_auto_souris3(x){
        ctx3.clearRect(0, 0, canvas3.width, canvas3.height) // on efface le canvas
        for(i3=0;i3<=nb_images3;i3++){
                var_x3[i3]+=x; // on ajoute la différence en x de la souris lors du click sans relâché
        }
        for(i3=0;i3<=nb_images3;i3++){
                ctx3.drawImage(images3[i3], var_x3[i3], 0, 150, canvas3.height); // on réintroduit les images3
        }
        if(var_x3[0]<=-150){var_x3[0]=(var_x3[nb_images3]+160)} // test si les images3 sortent du canvas à gauche
        for(i3=1;i3<=nb_images3;i3++){
                if(var_x3[i3]<=-150){var_x3[i3]=(var_x3[i3-1]+160)}
        }
        if(var_x3[nb_images3-0]>(160*nb_images3)){var_x3[nb_images3-0]=(var_x3[0]-160)} // test si les images3 sortent de la limite maximum à droite
        for(i3=1;i3<=nb_images3;i3++){
                if(var_x3[nb_images3-i3]>(160*nb_images3)){var_x3[nb_images3-i3]=(var_x3[(nb_images3-(i3-1))]-160)}
        }
}


canvas3.addEventListener("mousedown", function(event) { // lors du click sans relâché de la souris
        if (event.button == "0"){ // seulement si c'est le click gauche de la souris
                pause3=1; // on met en pause la translation automatique
                pausex3 = event.clientX; // premier enregistrement des x
        }
});


document.addEventListener("mouseup", function(event) { // lors du relâchement du click de la souris
        pause3=0; // on remet en route la translation automatique
});


function coulissement_souris3(event){ // fonction de coulissmeent de la souris
        canvas3.addEventListener("mousemove", function(event) { // si la souris à bougé dans le canvas seulement
                if(pause3==1){ // si la translation est toujours en pause
                        var pausex_suite3 = event.clientX; // on enregistre la position suivante de la souris
                        if(pausex_suite3!=pausex3){ // si la position suivante est différente de la position initiale
                                deplacement3=1; // on active le déplacement pour éviter le click de l'image, car l'utilisateur cherche le déplacement et non le lien de l'image
                                coulissement_auto_souris3(pausex_suite3 - pausex3); // on envoit à la fonction la différence en x
                                pausex3 = pausex_suite3; // on remet la différence à 0
                        }
                }
        });
}


setInterval("if(pause3==0){coulissement_auto3();}", 20); // coulissement automatique si pause n'est pas activé
setInterval("if(pause3==1){coulissement_souris3(event);}", 20); // fonction du calcul du coulissement seulement si pause est activé


canvas3.addEventListener("click", function(event) { // click avec relâché de la souris (dans le canvas) pour entrer dans le lien de l'image
        clickx3 = (event.clientX - container3.left); // on regarde la position de la souris en x
        if(deplacement3==0){ // si ce n'est pas considéré comme un déplacemement


        // for(i3=0;i3<nb_images3;i3++){
        //         if(clickx3>=var_x3[i3]-5 && clickx3<=var_x3[i3+1]-5){alert("image" + (i3+1));} // offset
        // }
        // if(clickx3>=var_x3[nb_images3]-5 && clickx3<=var_x3[0]-5){alert("image" + (nb_images3+1));}


        for(i3=0;i3<nb_images3;i3++){
                if(clickx3>=var_x3[i3]-5 && clickx3<=var_x3[i3+1]-5){
                        var valeur3 = images3[i3].getAttribute("id"); // pointage sur l'image et récupération de la valeur de l'id
                }
        }
        if(clickx3>=var_x3[nb_images3]-5 && clickx3<=var_x3[0]-5){
                var valeur3 = images3[nb_images3].getAttribute("id"); // pointage sur l'image et récupération de la valeur de l'id
        }
        document.location.href="./allocine.php?p=a&i=" + valeur3; // redirection de la page avec envoi de l'id en méthode GET




        }else{
                deplacement3=0; // on désactive le déplacement si il a eu lieu
        }
});
