<!-- Asks the user to fill out the form to submit a recipe -->
<div class="text-center">
    <div class="row">
        <div class="nine columns">
            <form action="recipe.php" method="post">
                <fieldset>
                    <div class="row collapse">
                        <h3>Submit a Recipe!</h3>
                    </div>
                    <div class="row collapse">
                        <input autofocus name="title" placeholder="Title" type="text"/>
                    </div>
                    <div class="row collapse">
                        <textarea rows="4" name="description" placeholder="Description" type="text"></textarea>
                    </div>
                    <label>Ingredients: </label>
                    <input type="checkbox" name="ingredients[]" value="Milk"> Milk
                    <input type="checkbox" name="ingredients[]" value="Butter"> Butter
                    <input type="checkbox" name="ingredients[]" value="Cheese"> Cheese<br/><br/>
                    <div class="row collapse">
                        <textarea rows="6" name="instructions" placeholder="Instructions" type="text"></textarea>
                    </div>
                    <label>Tags: </label>
                    <input type="checkbox" name="tags[]" value="Milk"> Milk
                    <input type="checkbox" name="tags[]" value="Butter"> Butter
                    <input type="checkbox" name="tags[]" value="Cheese"> Cheese<br/><br/>
                    <div class="row collapse">
                        <button type="submit" class="radius button">Submit</button>
                    </div><br/>
                </fieldset>
            </form>
        </div>
    </div>
</div>
