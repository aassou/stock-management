//client section
function autocompletClient() {
	var min_length = 1; // min caracters to display the autocomplete
	var keyword = $('#nomClient').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax-refresh-client.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#clientList').show();
				$('#clientList').html(data);
			}
		});
	} 
	else {
		$('#clientList').hide();
	}
}
// set_item client : this function will be executed when we select an item
function setItemClient(item1, item2, item3, item4, item5, item6){
	// change input value
	$('#nomClient').val(item1);
	$('#cin').val(item2);
	$('#ville').val(item3);
	$('#telephone').val(item4);
	$('#code').val(item5);
	$('#idClient').val(item6);
	// hide proposition list
	$('#clientList').hide();
}
///
//produit section
function autocompletProduit() {
	var min_length = 1; // min caracters to display the autocomplete
	var keyword = $('#codeProduit').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax-refresh-produit.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#produitList').show();
				$('#produitList').html(data);
			}
		});
	} 
	else {
		$('#produitList').hide();
	}
}
// set_item produit : this function will be executed when we select an item
function setItemProduit(item1, item2, item3, item4, item5, item6, item7, item8){
	// change input value
	$('#codeProduit').val(item1);
	$('#dimension1').val(item2);
	$('#dimension2').val(item3);
	$('#prixAchat').val(item4);
	$('#prixVente').val(item5);
	$('#prixVenteMin').text('PrixMin='+item6);
	$('#quantite').text('Stock='+item7);
	$('#idProduit').val(item8);
	// hide proposition list
	$('#produitList').hide();
}
///
//fournisseur section
function autocompletFournisseur() {
	var min_length = 1; // min caracters to display the autocomplete
	var keyword = $('#nomFournisseur').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax-refresh-fournisseur.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#fournisseurList').show();
				$('#fournisseurList').html(data);
			}
		});
	} 
	else {
		$('#fournisseurList').hide();
	}
}
// set_item fournisseur : this function will be executed when we select an item
function setItemFournisseur(item1, item2, item3, item4, item5, item6, item7){
	// change input value
	$('#nomFournisseur').val(item1);
	$('#adresse').val(item2);
	$('#telephone1').val(item3);
	$('#telephone2').val(item4);
	$('#email').val(item5);
	$('#fax').val(item6);
	$('#idFournisseur').val(item7);
	// hide proposition list
	$('#fournisseurList').hide();
}
///
//employeProjet section
function autocompletEmployeProjet() {
	var min_length = 1; // min caracters to display the autocomplete
	var keyword = $('#nomEmployeProjet').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax-refresh-employe-projet.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#employeProjetList').show();
				$('#employeProjetList').html(data);
			}
		});
	} 
	else {
		$('#employeProjetList').hide();
	}
}
// set_item employeProjet : this function will be executed when we select an item
function setItemEmployeProjet(item1){
	// change input value
	$('#nomEmployeProjet').val(item1);
	// hide proposition list
	$('#employeProjetList').hide();
}
//Projet section
function autocompletProjet() {
	var min_length = 1; // min caracters to display the autocomplete
	var keyword = $('#nomProjet').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax-refresh-projet.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#projetList').show();
				$('#projetList').html(data);
			}
		});
	} 
	else {
		$('#projetList').hide();
	}
}
// set_item Projet : this function will be executed when we select an item
function setItemProjet(item1, item2){
	// change input value
	$('#nomProjet').val(item1);
	$('#idProjet').val(item2);
	// hide proposition list
	$('#projetList').hide();
}