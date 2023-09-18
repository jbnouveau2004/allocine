var var_x1 = [];
var pause1 = 0; // déclare si il y a pause de translation
var pausex1; // sert aux calculs de x pour les déplacements
var canvas1 = document.getElementById("canvas1");
var ctx1 = canvas1.getContext("2d");
const container1 = canvas1.getBoundingClientRect();
var deplacement1 = 0; // évite les clicks intempestives lors du déplacement
var images1 = canvas1.getElementsByTagName('img');
var nb_images1 = images1.length - 1 ; // nombre d'image - 1

for(i1=0;i1<=nb_images1;i1++){ // on déclare les positions d'origine
        var_x1[i1] = i1 * 160;
}

window.onload = function() { // on affiche tout
        for(i1=0;i1<=nb_images1;i1++){
                ctx1.drawImage(images1[i1], var_x1[i1], 0, 150, canvas1.height);
        }
};

function coulissement_auto1(){
        ctx1.clearRect(0, 0, canvas1.width, canvas1.height) // on efface le canvas
        for(i1=0;i1<=nb_images1;i1++){
                var_x1[i1]-=1; // on décrémente tout
        }   
        for(i1=0;i1<=nb_images1;i1++){
                ctx1.drawImage(images1[i1], var_x1[i1], 0, 150, canvas1.height); // on réintroduit les images1 après les décrémentations
        }
        if(var_x1[0]==-150){var_x1[0]=(var_x1[nb_images1]+160)}  // on teste si l'image le plus à gauche sort du canvas
        for(i1=1;i1<=nb_images1;i1++){
                if(var_x1[i1]==-150){var_x1[i1]=(var_x1[i1-1]+160)}
        } 
}

function coulissement_auto_souris1(x){
        ctx1.clearRect(0, 0, canvas1.width, canvas1.height) // on efface le canvas
        for(i1=0;i1<=nb_images1;i1++){
                var_x1[i1]+=x; // on ajoute la différence en x de la souris lors du click sans relâché
        }
        for(i1=0;i1<=nb_images1;i1++){
                ctx1.drawImage(images1[i1], var_x1[i1], 0, 150, canvas1.height); // on réintroduit les images1
        }
        if(var_x1[0]<=-150){var_x1[0]=(var_x1[nb_images1]+160)} // test si les images1 sortent du canvas à gauche
        for(i1=1;i1<=nb_images1;i1++){
                if(var_x1[i1]<=-150){var_x1[i1]=(var_x1[i1-1]+160)}
        }
        if(var_x1[nb_images1-0]>(160*nb_images1)){var_x1[nb_images1-0]=(var_x1[0]-160)} // test si les images1 sortent de la limite maximum à droite
        for(i1=1;i1<=nb_images1;i1++){
                if(var_x1[nb_images1-i1]>(160*nb_images1)){var_x1[nb_images1-i1]=(var_x1[(nb_images1-(i1-1))]-160)}
        }
}


canvas1.addEventListener("mousedown", function(event) { // lors du click sans relâché de la souris
        if (event.button == "0"){ // seulement si c'est le click gauche de la souris
                pause1=1; // on met en pause la translation automatique
                pausex1 = event.clientX; // premier enregistrement des x
        }
});


document.addEventListener("mouseup", function(event) { // lors du relâchement du click de la souris
        pause1=0; // on remet en route la translation automatique
});


function coulissement_souris1(event){ // fonction de coulissmeent de la souris
        canvas1.addEventListener("mousemove", function(event) { // si la souris à bougé dans le canvas seulement
                if(pause1==1){ // si la translation est toujours en pause
                        var pausex_suite1 = event.clientX; // on enregistre la position suivante de la souris
                        if(pausex_suite1!=pausex1){ // si la position suivante est différente de la position initiale
                                deplacement1=1; // on active le déplacement pour éviter le click de l'image, car l'utilisateur cherche le déplacement et non le lien de l'image
                                coulissement_auto_souris1(pausex_suite1 - pausex1); // on envoit à la fonction la différence en x
                                pausex1 = pausex_suite1; // on remet la différence à 0
                        }
                }
        });
}


setInterval("if(pause1==0){coulissement_auto1();}", 20); // coulissement automatique si pause n'est pas activé
setInterval("if(pause1==1){coulissement_souris1(event);}", 20); // fonction du calcul du coulissement seulement si pause est activé


canvas1.addEventListener("click", function(event) { // click avec relâché de la souris (dans le canvas) pour entrer dans le lien de l'image
        clickx1 = (event.clientX - container1.left); // on regarde la position de la souris en x
        if(deplacement1==0){ // si ce n'est pas considéré comme un déplacemement


        // for(i1=0;i1<nb_images1;i1++){
        //         if(clickx1>=var_x1[i1]-5 && clickx1<=var_x1[i1+1]-5){alert("image" + (i1+1));} // offset
        // }
        // if(clickx1>=var_x1[nb_images1]-5 && clickx1<=var_x1[0]-5){alert("image" + (nb_images1+1));}


        for(i1=0;i1<nb_images1;i1++){
                if(clickx1>=var_x1[i1]-5 && clickx1<=var_x1[i1+1]-5){
                        var valeur1 = images1[i1].getAttribute("id"); // pointage sur l'image et récupération de la valeur de l'id
                }
        }
        if(clickx1>=var_x1[nb_images1]-5 && clickx1<=var_x1[0]-5){
                var valeur1 = images1[nb_images1].getAttribute("id"); // pointage sur l'image et récupération de la valeur de l'id
        }
        document.location.href="./allocine.php?p=a&i=" + valeur1; // redirection de la page avec envoi de l'id en méthode GET




        }else{
                deplacement1=0; // on désactive le déplacement si il a eu lieu
        }
});
