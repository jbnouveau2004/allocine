var var_x2 = [];
var pause2 = 0; // déclare si il y a pause de translation
var pausex2; // sert aux calculs de x pour les déplacements
var canvas2 = document.getElementById("canvas2");
var ctx2 = canvas2.getContext("2d");
const container2 = canvas2.getBoundingClientRect();
var deplacement2 = 0; // évite les clicks intempestives lors du déplacement
var images2 = canvas2.getElementsByTagName('img');
var nb_images2 = images2.length - 1 ; // nombre d'image - 1

for(i2=0;i2<=nb_images2;i2++){ // on déclare les positions d'origine
        var_x2[i2] = i2 * 160;
}

window.onload = function() { // on affiche tout
        for(i2=0;i2<=nb_images2;i2++){
                ctx2.drawImage(images2[i2], var_x2[i2], 0, 150, canvas2.height);
        }
};

function coulissement_auto2(){
        ctx2.clearRect(0, 0, canvas2.width, canvas2.height) // on efface le canvas
        for(i2=0;i2<=nb_images2;i2++){
                var_x2[i2]-=1; // on décrémente tout
        }   
        for(i2=0;i2<=nb_images2;i2++){
                ctx2.drawImage(images2[i2], var_x2[i2], 0, 150, canvas2.height); // on réintroduit les images2 après les décrémentations
        }
        if(var_x2[0]==-150){var_x2[0]=(var_x2[nb_images2]+160)}  // on teste si l'image le plus à gauche sort du canvas
        for(i2=1;i2<=nb_images2;i2++){
                if(var_x2[i2]==-150){var_x2[i2]=(var_x2[i2-1]+160)}
        } 
}

function coulissement_auto_souris2(x){
        ctx2.clearRect(0, 0, canvas2.width, canvas2.height) // on efface le canvas
        for(i2=0;i2<=nb_images2;i2++){
                var_x2[i2]+=x; // on ajoute la différence en x de la souris lors du click sans relâché
        }
        for(i2=0;i2<=nb_images2;i2++){
                ctx2.drawImage(images2[i2], var_x2[i2], 0, 150, canvas2.height); // on réintroduit les images2
        }
        if(var_x2[0]<=-150){var_x2[0]=(var_x2[nb_images2]+160)} // test si les images2 sortent du canvas à gauche
        for(i2=1;i2<=nb_images2;i2++){
                if(var_x2[i2]<=-150){var_x2[i2]=(var_x2[i2-1]+160)}
        }
        if(var_x2[nb_images2-0]>(160*nb_images2)){var_x2[nb_images2-0]=(var_x2[0]-160)} // test si les images2 sortent de la limite maximum à droite
        for(i2=1;i2<=nb_images2;i2++){
                if(var_x2[nb_images2-i2]>(160*nb_images2)){var_x2[nb_images2-i2]=(var_x2[(nb_images2-(i2-1))]-160)}
        }
}


canvas2.addEventListener("mousedown", function(event) { // lors du click sans relâché de la souris
        if (event.button == "0"){ // seulement si c'est le click gauche de la souris
                pause2=1; // on met en pause la translation automatique
                pausex2 = event.clientX; // premier enregistrement des x
        }
});


document.addEventListener("mouseup", function(event) { // lors du relâchement du click de la souris
        pause2=0; // on remet en route la translation automatique
});


function coulissement_souris2(event){ // fonction de coulissmeent de la souris
        canvas2.addEventListener("mousemove", function(event) { // si la souris à bougé dans le canvas seulement
                if(pause2==1){ // si la translation est toujours en pause
                        var pausex_suite2 = event.clientX; // on enregistre la position suivante de la souris
                        if(pausex_suite2!=pausex2){ // si la position suivante est différente de la position initiale
                                deplacement2=1; // on active le déplacement pour éviter le click de l'image, car l'utilisateur cherche le déplacement et non le lien de l'image
                                coulissement_auto_souris2(pausex_suite2 - pausex2); // on envoit à la fonction la différence en x
                                pausex2 = pausex_suite2; // on remet la différence à 0
                        }
                }
        });
}


setInterval("if(pause2==0){coulissement_auto2();}", 20); // coulissement automatique si pause n'est pas activé
setInterval("if(pause2==1){coulissement_souris2(event);}", 20); // fonction du calcul du coulissement seulement si pause est activé


canvas2.addEventListener("click", function(event) { // click avec relâché de la souris (dans le canvas) pour entrer dans le lien de l'image
        clickx2 = (event.clientX - container2.left); // on regarde la position de la souris en x
        if(deplacement2==0){ // si ce n'est pas considéré comme un déplacemement




        // for(i2=0;i2<nb_images2;i2++){
        //         if(clickx2>=var_x2[i2]-5 && clickx2<=var_x2[i2+1]-5){alert("image" + (i2+1));} // offset
        // }
        // if(clickx2>=var_x2[nb_images2]-5 && clickx2<=var_x2[0]-5){alert("image" + (nb_images2+1));}



        for(i2=0;i2<nb_images2;i2++){
                if(clickx2>=var_x2[i2]-5 && clickx2<=var_x2[i2+1]-5){
                        var valeur2 = images2[i2].getAttribute("id"); // pointage sur l'image et récupération de la valeur de l'id
                }
        }
        if(clickx2>=var_x2[nb_images2]-5 && clickx2<=var_x2[0]-5){
                var valeur2 = images2[nb_images2].getAttribute("id"); // pointage sur l'image et récupération de la valeur de l'id
        }
        document.location.href="./allocine.php?p=a&i=" + valeur2; // redirection de la page avec envoi de l'id en méthode GET






        }else{
                deplacement2=0; // on désactive le déplacement si il a eu lieu
        }
});
