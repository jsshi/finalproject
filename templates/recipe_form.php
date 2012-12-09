<!-- Asks the user to fill out the form to submit a recipe -->

<div class="text-center">
    <div class="row">
    <div class="offset-by-two">
        <div class="ten columns">
            <form action="recipe.php" method="post">
                <fieldset>
                    <div class="row collapse">
                        <h3>Submit a Recipe!</h3>
                    </div>
                    
                    <!-- submit title and description -->
                    <div class="row collapse">
                        <input autofocus name="title" placeholder="Title" type="text"/>
                    </div>
                    <div class="row collapse">
                        <textarea rows="4" name="description" placeholder="Description" type="text"></textarea>
                    </div>
                    <!-- loop through ingredients array to make checkboxes -->
                    <label>Ingredients: </label>
                    <?php
                        $count = 0;
                        foreach ($ingredients as $ingredient)
                        {
                            print("<input type = 'checkbox' name='i[$count]' value='1'> $ingredient");
                            
                            // makes the output look neat and orderly
                            if (($count + 1) % 5 == 0)
                                print("<br/>");
                            $count++;
                        }
                    ?>
                    <br/><br/>
                    
                    <div class="row collapse">
                        <textarea rows="6" name="instructions" placeholder="Instructions" type="text"></textarea>
                    </div>
                    
                    <!-- loop through tags array to make checkboxes -->
                    <label>Tags: </label>
                    <?php
                        $count = 0;
                        foreach ($tags as $tag)
                        {
                            print("<input type = 'checkbox' name='t[$count]' value='1'> $tag");
                            
                            // makes the output look neat and orderly
                            if (($count + 1) % 6 == 0)
                                print("<br/>");
                            $count++;
                        }
                    ?>
                        
                        <br/><br/>
                    <div class="row collapse">
                        <button type="submit" class="radius button">Submit</button>
                    </div><br/>
                </fieldset>
            </form>
        </div>
    </div>
</div>
</div>
