ingredientSelects = [{value: undefined, amount: undefined}];

function addIngredientsSelect(id, selectedValue, amount) {
    isNew = (id !== undefined) ? false : true;
    id = (id !== undefined) ? id : ingredientSelects.length;
    let html = `
        <div class="form-group row ingredient-select-group" id="ingredient-select-group-${id}">
            <label for="ingredient-select-${id}" class="col-sm-1 col-form-label">Zutat ${id + 1}</label>
            <div class="col-sm-6">
                <select id="ingredient-select-${id}" data-id="${id}" name="ingredient-select-${id}" class="form-control ingredient-select selectpicker" data-live-search="true" title="Zutat auswählen...">
                    ${availableIngredients.map(ingredient => '<option data-tokens="'+ingredient.title+'" value="'+ingredient.id+'">'+ingredient.title+'</option>')}
                </select>
            </div>
            <div class="col-md-${id !== 0 ? '4' : '5'}">
                <input type="text" class="form-control" id="ingredient-amount-${id}" data-id="${id}" name="ingredient-amount-${id}" value="${amount ? amount : ''}" placeholder="Menge">
            </div>
            ${ id !== 0 ? `
                <div class="col-md-1">
                    <button id="remove-ingredient-filter-${id}-btn" class="btn btn-outline-danger remove-ingredient-filter-btn" data-id="${id}"><i class="fas fa-times"></i></button>
                </div>
            ` : ''}
        </div>
    `;

    let existingEls = document.querySelectorAll('.ingredient-select-group');
    if(existingEls.length > 0) {
        existingEls[existingEls.length-1].insertAdjacentHTML('afterend', html);
        document.querySelector(`#remove-ingredient-filter-${id}-btn`).addEventListener('click', ($event) => {
            $event.preventDefault();
            let id = $event.target.getAttribute('data-id');
            if(!id) {
                id = $event.target.closest('.remove-ingredient-filter-btn').getAttribute('data-id');
            }
            removeIngredientSelect(id);
        });
    } else {
        document.querySelector('#add-ingredient-filter-group').insertAdjacentHTML('beforeBegin', html);
    }

    if(selectedValue) {
        $('#ingredient-select-'+id).selectpicker('val', selectedValue);
    } else {
        $('#ingredient-select-'+id).selectpicker();
    }

    if(isNew) {
        ingredientSelects.push({value: undefined, amount: undefined});
    }
    
    $('#ingredient-select-'+id).on('changed.bs.select', (e, clickedIndex, isSelected, previousValue) => {
        let id = parseInt(e.target.getAttribute('data-id'));
        let val = e.target.value;
        ingredientSelects[id].value = val;
    });
    document.querySelector('#ingredient-amount-'+id).addEventListener('input', ($event) => {
        let id = parseInt($event.target.getAttribute('data-id'));
        let val = $event.target.value;
        ingredientSelects[id].amount = val;
    });

}

function removeIngredientSelect(index) {
    index = index;
    ingredientSelects.splice(index, 1);
    renderAllIngredients();
}

function renderAllIngredients() {
    document.querySelectorAll('.ingredient-select-group').forEach(element => {
        element.remove();
    });
    for(let i = 0; i < ingredientSelects.length; i++) {
        addIngredientsSelect(i, ingredientSelects[i].value, ingredientSelects[i].amount);
    }
}
var descriptionEditor;
var recipeEditor;  
(() => {
    var quillOptions = {
        debug: 'warn',
        theme: 'snow'
    };
    descriptionEditor = new Quill('#description-input', quillOptions);
    recipeEditor = new Quill('#recipe-input', quillOptions);
    recipeEditor.root.innerHTML  = document.querySelector('#recipe-text-input').value;
    descriptionEditor.root.innerHTML = document.querySelector('#description-text-input').value;

    // Quill Editor Inhalt wird leider nicht als Forumal Feld zur verfügung gestellt
    // Deshalb gibt es ein hidden Input welcher bei einer Änderung in Quill mit dem Inhalt des Editors gefüllt wird.
    descriptionEditor.on('text-change', (delta, oldDelta, source) => {
        document.querySelector('#description-text-input').value = descriptionEditor.root.innerHTML;
    });
    recipeEditor.on('text-change', (delta, oldDelta, source) => {
        document.querySelector('#recipe-text-input').value = recipeEditor.root.innerHTML;
    });

    // Initialisierung des Select Plugins
    $('#ingredient-select-0').selectpicker();
    $('#ingredient-select-0').on('changed.bs.select', (e, clickedIndex, isSelected, previousValue) => {
        let id = parseInt(e.target.getAttribute('data-id'));
        let val = e.target.value;
        ingredientSelects[id].value = val;
    });
    document.querySelector('#ingredient-amount-0').addEventListener('input', ($event) => {
        let id = parseInt($event.target.getAttribute('data-id'));
        let val = $event.target.value;
        ingredientSelects[id].amount = val;
    });

    document.querySelector('#cocktail-image-input').addEventListener('change', ($event) => {
        console.log($event);
        document.querySelector('[for="cocktail-image-input"]').innerHTML = $event.target.value.substr($event.target.value.lastIndexOf('\\') + 1);
    });


    document.querySelector('#add-ingredient-filter-btn').addEventListener('click', ($event) => {
        // preventDefault wird benötigt, da ein Click auf einen Button in eine Formular ein Submit Event auslöst.
        // Das hat zur Folge, dass der Browser das Formular an den Server schicken will und die Seite neu lädt und
        // den eigentlichem Code nicht ausführt.
        $event.preventDefault();
        addIngredientsSelect();
    });
})();