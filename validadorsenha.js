// Criado por Sam.
// Adaptado de https://pt.stackoverflow.com/questions/316987/validar-for%C3%A7a-da-senha-no-front-end

document.addEventListener("DOMContentLoaded", function(){

    document.forms[0].onsubmit = function(e){
       return val(e);
    }
 
    senha.oninput = function(e){
       val(e);
    }
 
    function val(e){
 
       var qtde = 0,
           v = senha.value,
           cor = "#fff",
           e = e.type == "submit";
    
       // verifica se tem 6 caracteres ou mais
       if(v.match(/.{6,}/))
            qtde++;

       // verifica se tem ao menos uma letra maiÃºscula
       if(v.match(/[A-Z]{1,}/))
            qtde++;
 
       // verifica de tem ao menus um nÃºmero
       if(v.match(/[0-9]{1,}/))
            qtde++;
 
       var validacao = 'Senha Fraca <i class="fa-solid fa-battery-empty"></i>';
       switch (qtde)
       {
            case 2:
                validacao = 'Senha Média <i class="fa-solid fa-battery-half"></i>';
                document.getElementById('medidor').innerHTML = validacao;
                break;
            case 3:
                validacao = 'Senha Forte <i class="fa-solid fa-battery-full"></i>'; break;
       }

       document.getElementById('medidor').innerHTML = validacao;
    }
 });