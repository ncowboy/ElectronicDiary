    $(function(){
        $('.btn-delete').on('click', function(){
            var keys = $('#kv-grid-students').yiiGridView('getSelectedRows');
            var data = {
                group: null,
                students: []
            };
            keys.forEach(function(item){
                data['students'].push(item['student_id']);
                data.group = item['group_id'];
            });
            $.post("/students-in-group/multipledelete", data, function(){
                console.log('успех');
            }) ;
      });
    });





