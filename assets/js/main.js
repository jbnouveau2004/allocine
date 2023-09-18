jQuery(function(){



    $('#recherche').keyup(function(event){
        $.ajax({           
            type: "POST",
            url: "../models/ajax1.php",
            data: 'lettre=' + $(this).val(),
    
            success: function(data)
             {
                 $("#menu").show(data);
                 $("#menu").html(data);
             }
         });
    return false;
    });
    
    $('#menu').click(function(event){
      $.ajax({           
          type: "POST",
          url: "../models/ajax1.php",
          data: 'lettre=' + $('#recherche').val(),
    
          success: function(data)
           {
               $("#menu").hide(data);
           }
       });
    return false;
    });
    
    
    
    });
    
    
    function choix(mot){
        
    document.getElementById('recherche').value = String(mot).replace( "&#039;", "'").replace( "&eacute;", "é").replace( "&Eacute;", "É").replace( "&egrave;", "è").replace( "&ecirc;", "ê").replace( "&Ecirc;", "Ê").replace( "&agrave;", "à").replace( "&Agrave;", "À").replace( "&acirc;", "â").replace( "&iuml;", "ï"); // suite à un htmlentitites, pas le choix
    }
    
    function go(){
      $.ajax({           
        type: "POST",
        url: "../models/ajax2.php",
        data: 'titre=' + $('#recherche').val(),
  
        success: function(data)
         {
            if(data){
                document.location.href="../controllers/allocine.php?p=a&i=" + data; // redirection de la page avec envoi de l'id en méthode GET
            }
         }
     });
    }