<!-- Asks the user to fill out the form to submit a recipe -->

<div class="text-center">
    <div class="row">
    <div class="offset-by-two">
        <div class="ten columns">
            <form name="contactform" method="post" action="contact.php">
                <fieldset>
                    <div class="row collapse">
                        <h2>Questions, Comments, or Concerns?</h2>
                        <h3>Send us an email!</h3>
                    </div>
                    
                    <!-- email form -->
                    <div class="row collapse">
                        <input autofocus name="name" placeholder="Name" type="text"/>
                    </div>    
                    <div class="row collapse">
                        <input name="email" placeholder="Email Address" type="text"/>
                    </div>
                    <div class="row collapse">
                        <textarea rows="6" name="message" placeholder="Message" type="text"></textarea>
                    </div>
                    <div class="row collapse">
                        <button type="submit" class="radius button">Submit</button>
                    </div><br/>
                </fieldset>
            </form>
        </div>
    </div>
</div>
</div>
