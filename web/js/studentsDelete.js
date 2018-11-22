        $(function(){
        $('.btn-delete').on('click', function(){ 
            var keys = $('#kv-grid-students').yiiGridView('getSelectedRows');
            var moduleName = window.location.pathname.split('/')[1];
            var groupIdElem = $('.group-grid').attr('id');
            var groupId = groupIdElem.substr(9);
            var data = {
                group: groupId,
                students: []
            };
            if(keys.length === 0) {
                alert('Не выбран ни один студент');
            }
            else {
                keys.forEach(function(item){
                    data['students'].push(item);
                });
                $.post("/" + moduleName + "/students-in-group/multipledelete", data, function(){
                    console.log('Success');
                })
            }
      });
    });





