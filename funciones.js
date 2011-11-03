function eliminar(url)
{
	if (confirm("Realmente desea eliminar esta movie ?"))
	{
		window.location=url;
	}
}

function editar(url, nom, plot, durac, direct, cast, yea, ran, disc, id)
{
	var tit = document.getElementById(nom).value;
	var resumen = document.getElementById(plot).value;
	var duracion = document.getElementById(durac).value;
	var director = document.getElementById(direct).value;
	var elenco = document.getElementById(cast).value;
	var year = document.getElementById(yea).value;
	var rank = document.getElementById(ran).value;
	var disco = document.getElementById(disc).value;
	var id_movie = document.getElementById(id).value;

	if (confirm("Realmente desea editar esta movie ?"))
	{
		window.location=url + '?tit=' + tit + '&plot=' + resumen + '&length=' + duracion + '&dir=' + director + '&cast=' + elenco + '&yea=' + year + '&rank=' + rank + '&disc=' + disco + '&id=' + id_movie;
	}
}

function editar_img(url, ima_new, id)
{
	var img = document.getElementById(ima_new).value;
	var id = document.getElementById(id).value;
	if (confirm("Realmente desea editar esta imagen ?"))
	{
		window.location=url + '?ima_new=' + img + '&id=' + id;
	}
}

function valida_nums(numero)
{
	if(/\d{2}/.test(numero))
	{
		return (true);
	}
	else
	{
		return (false);
	}


 }


function valida_ingreso(){
    //alert("Hi");
  var form = document.form;
	if(form.tit.value==0)
    {
        alert("Ingrese un titulo");
        form.tit.value = "";
        form.tit.focus();
        return false;
    }
    if(form.plot.value==0)
    {
        alert("Ingrese un plot");
        form.plot.value = "";
        form.plot.focus();
        return false;
    }
	if(form.length.value==0)
    {
        alert("Ingrese una duracion");
        form.length.value = "";
        form.length.focus();
        return false;
    }
	if(valida_nums(form.length.value)==false)
    {
        alert("La duracion ingresada no es correcta");
        form.length.value = "";
        form.length.focus();
        return false;
    }
	if(form.dir.value==0)
    {
        alert("Ingrese un director");
        form.dir.value = "";
        form.dir.focus();
        return false;
    }
	if(form.cast.value==0)
    {
        alert("Ingrese un elenco");
        form.cast.value = "";
        form.cast.focus();
        return false;
    }
	if(form.genre_.value=='Genero')
    {
        alert("Seleccione un genero");
        form.genre_.value = "Genero";
        form.genre_.focus();
        return false;
    }
	if(form.year.value=='Seleccione')
    {
        alert("Ingrese un año");
        form.year.value = "";
        form.year.focus();
        return false;
    }
	/* 	if(valida_nums(form.year.value)==false)
    {
        alert("El año ingresado no es correcto");
        form.year.value = "";
        form.year.focus();
        return false;
    } */
	if(form.rank.value=='Seleccione')
    {
        alert("Ingrese un ranking");
        form.rank.value = "";
        form.rank.focus();
        return false;
    }
/* 	if(valida_nums(form.rank.value)==false)
    {
        alert("El ranking ingresado no es correcto");
        form.rank.value = "";
        form.rank.focus();
        return false;
    } */
	if(form.ima_new.value=='')
    {
        alert("Elija una imagen");
        form.ima_new.value = "";
        form.ima_new.focus();
        return false;
    }
	if(form.disctextarea.value=='disco')
    {
        alert("Seleccione un disco");
        form.disctextarea.value = "Disco";
        form.disctextarea.focus();
        return false;
    }
/* 	if(form.stars.value=='Seleccione')
    {
        alert("Seleccione una imagen de estrellas a mostrar");
        form.stars.value = "Seleccione";
        form.stars.focus();
        return false;
    } */
	form.submit();
}





