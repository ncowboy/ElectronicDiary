    $(function(){
        $('.btn-delete').on('click', function(){
            var keys = $('#kv-grid-students').yiiGridView('getSelectedRows');
            console.log(keys);
            var data = {
                group: null,
                students: []
            };
            if(keys.length === 0) {
                alert('Не выбран ни один студент');
            }
            else {
                keys.forEach(function(item){
                    data['students'].push(item['student_id']);
                    data.group = item['group_id'];
                });
                $.post("/students-in-group/multipledelete", data, function(){
                    console.log('Success');
                }) 
            }
      });
    });





