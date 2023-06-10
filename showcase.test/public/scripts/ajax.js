$(document).ready(function() {
    $('body').on('click', 'button.xhr', function () {
        let id = $(this).attr('_id');
        if ($(this).hasClass('edit')) {
            return edit(id);
        } else if ($(this).hasClass('create')) {
            return create(); 
        } else if ($(this).hasClass('show')) {
            return show(id);
        }
        return destroy(id); 
    }); 
    
    $('body').on('submit', 'form', function(e) {
        e.preventDefault();
        if ($(this).hasClass('update')) {
            return update($(this));
        } 
        return store($(this));
    });
    
    function show (id) {
        $.get("show/" + id).done(function(result) {
            $('.content').html(result);
       })
       .fail(function(err) {
           console.warn('error in show', err);
       });
    }
    
    function edit (id) {
       $.get("edit/" + id).done(function(result) {
            $('.content').html(result);
       })
       .fail(function(err) {
           console.warn('error in edit', err);
       });
    }
    
    function create () {
        $.get("create").done(function(result) {
            $('.content').html(result);
        })
        .fail(function(err) {
           console.warn('error in create', err);
        });
    }
    
    function destroy (id) {
        $.post("delete/" + id).done(function(result) {
            $('.content').html(result);
       })
       .fail(function(err) {
           console.warn('error in destroy', err);
       });
    }
    
    function update ($form) {
        let name = $form.find('input[name="name"]').val();
        let id = $form.find('input[name="id"]').val();
        $.post('update/' + id, {name: name}).done(function(result) {
            $('.content').html(result);
        })
        .fail(function(err) {
           console.warn('error in update', err);
        });
    }
    
    function store ($form) {
        let name = $form.find('input[name="name"]').val();
        $.post('store', {name: name}).done(function(result) {
            $('.content').html(result);
        })
        .fail(function(err) {
           console.warn('error in store', err);
        });
    }
});
