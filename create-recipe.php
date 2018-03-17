<?php

	$textdata = array
	  (
	  array('name' => 'description', 'rows' => '5', 'cols'=> '10'),
	  array('name' => 'instructions', 'rows' => '5', 'cols'=> '10'),
	  );
?>


<div class="wrap">
<div class="form column-wrapper clearfix">
    <div class="cp-title">
        <?php echo $title; ?>
    </div>
    <div class="cp-text">
        <p>To submit your tasty recipe, please fill in all fields. Title your recipe, your source, put an eye-catching description, 
		list the ingredients and the instructions.</p>
    </div>
    <div class="form_validation_wrapper">
    	<?php echo validation_errors(); ?>
    </div>
    <?php echo form_open('kitchen/create'); ?>

    <label for="title">Title</label>
    <?php echo form_input('title', set_value('title'), TRUE); ?><br />
    
    <label for="source">Source</label>
    <?php echo form_input('source', set_value('source'), TRUE); ?><br />
    
    <label for="description">Description</label>
    <?php echo form_textarea($textdata[0], set_value($textdata[0]['name']), TRUE); ?><br />
    
    <label for="ingredients">Ingredients</label>

    <?php
    
        echo '<div class="ingred_input_wrapper">';
    	echo '<div id="ingredient_col1">';
	    for($i = 0; $i < 5; $i++) {
	    	$a = set_value('ingredients_col1['.$i.']');
	    	echo form_input('ingredients_col1[]', $a, TRUE);
	    }
	echo '</div>';
    	echo '<div id="ingredient_col2">';
	    for($i = 0; $i < 5; $i++) {
	    	$a = set_value('ingredients_col2['.$i.']');
	    	echo form_input('ingredients_col2[]', $a, TRUE);
	    }
	echo '</div>';
	echo '</div>';
    ?>
    
    <label for="instructions">Instructions</label>
    <?php echo form_textarea($textdata[1], set_value($textdata[1]['name']), TRUE); ?><br />
    
    <label for="ingredients_icing">Icing Ingredients (Optional)</label>
    <?php
        echo '<div class="ingred_input_wrapper">';
    	echo '<div id="ingredient_icing_col1">';
	    for($i = 0; $i < 5; $i++) {
	    	$a = set_value('ingredient_icing_col1['.$i.']');
	    	echo form_input('ingredient_icing_col1[]', $a, TRUE);
	    }
	echo '</div>';
    	echo '<div id="ingredient_icing_col2">';
	    for($i = 0; $i < 5; $i++) {
	    	$a = set_value('ingredient_icing_col2['.$i.']');
	    	echo form_input('ingredient_icing_col2[]', $a, TRUE);
	    }
	echo '</div>';
	echo '</div>';
    ?>
    
    <input type="submit" name="submit" value="Create Recipe" />

</form>
</div>
</div>

<script>

function createInputElement(typeValue, nameValue, inputColumn) {
  var newInput = document.createElement("input");
  var typeAttr = document.createAttribute("type");
  var nameAttr = document.createAttribute("name");

  typeAttr.value = typeValue;
  nameAttr.value = nameValue;

  newInput.setAttributeNode(typeAttr);
  newInput.setAttributeNode(nameAttr);

  inputColumn.appendChild(newInput);

}



document.getElementById("add").addEventListener("click", function(event) {
  // check how many been made first
  var inputs = document.getElementById("ingredient_col1");
  var inputs2 = document.getElementById("ingredient_col2");
  if (inputs !== null) {
    if (inputs.childElementCount == 5) {
      createInputElement('text', 'ingredients_col2[]', inputs2);
    } else {
      createInputElement('text', 'ingredients_col1[]', inputs);
    }
  }

}, false);

$("#remove").click(function() {
  var parent = $("#ingredient_col1");
  var children = $("#ingredient_col1").children();
  var children2 = $("#ingredient_col2").children();
  var i = 0;
  var j = 0;
  if (children2.length > j) {
    $(children2[i]).remove();
    j++;
  }

  if (children.length > i) {
    $(children[i]).remove();
    i++;
  }
  
  if (children.length + children2.length == 10) {
  	createInputElement('text', 'ingredients_col1[]', parent);
  }
  
});


/* Icing Ingredient JS */

document.getElementById("addIcing").addEventListener("click", function(event) {
  // check how many been made first
  var inputs = document.getElementById("ingredient_icing_col1");
  var inputs2 = document.getElementById("ingredient_icing_col2");
  if (inputs !== null) {
    if (inputs.childElementCount == 5) {
      createInputElement('text', 'ingredient_icing_col2[]', inputs2);
    } else {
      createInputElement('text', 'ingredient_icing_col1[]', inputs);
    }
  }

}, false);

$("#removeIcing").click(function() {
  var parent = $("#ingredient_icing_col1");
  var children = $("#ingredient_icing_col1").children();
  var children2 = $("#ingredient_icing_col2").children();
  var i = 0;
  var j = 0;
  if (children2.length > j) {
    $(children2[i]).remove();
    j++;
  }

  if (children.length > i) {
    $(children[i]).remove();
    i++;
  }
  
  if (children.length + children2.length == 10) {
  	createInputElement('text', 'ingredient_icing_col1[]', parent);
  }
  
});
  
</script>
