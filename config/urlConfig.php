<?php



 /**
  * Url router rules
 */


return [
  'login' => 'site/login',
  'admin' => 'admin/personal',
  'super' => 'super/personal',
  
  //users
  'users' => $role . '/users',
  'users/update' => 'admin/users/update',
  'users/view' => 'admin/users/view',
  'users/delete' => 'admin/users/delete',
  'users/changepass' => 'admin/users/changepass',
  'users/create' => 'admin/users/create',
  
   // admin/groups
  'groups' =>  $role . '/groups',
  'groups/update' => 'admin/groups/update',
  'groups/delete' => 'admin/groups/delete',
  'groups/view' => 'admin/groups/view',
  'groups/create' => 'admin/groups/create',
  'group-content' => 'admin/groups/group-content',
  
  // admin/students
  'students' => 'admin/students',
  'students/update' => 'admin/students/update',
  'students/delete' => 'admin/students/delete',
  'students/view' => 'admin/students/view',
  'students/create' => 'admin/students/create',
  
  // admin/teachers
  'teachers' => 'admin/teachers',
  'teachers/update' => 'admin/teachers/update',
  'teachers/delete' => 'admin/teachers/delete',
  'teachers/view' => 'admin/teachers/view',
  'teachers/create' => 'admin/teachers/create',
  
  // admin/lessons
  'lessons' => 'admin/lessons',
  'lessons/update' => 'admin/lessons/update',
  'lessons/delete' => 'admin/lessons/delete',
  'lessons/view' => 'admin/lessons/view',
  'lessons/create' => 'admin/lessons/create',
  'lessons/results' => 'admin/lessons/results',
  
  // admin/students-in-lesson
    'students-in-lesson' => 'admin/students-in-lesson',
  
  // admin/buildings
  'buildings' => 'admin/buildings',
  'buildings/update' => 'admin/buildings/update',
  'buildings/delete' => 'admin/buildings/delete',
  'buildings/view' => 'admin/buildings/view',
  'buildings/create' => 'admin/buildings/create',
  
  // admin/subjects
  'subjects' => 'admin/subjects',
  'subjects/update' => 'admin/subjects/update',
  'subjects/delete' => 'admin/subjects/delete',
  'subjects/view' => 'admin/subjects/view',
  'subjects/create' => 'admin/subjects/create',
  
  // admin/group-types
  'group-types' => 'admin/group-types',
  'group-types/update' => 'admin/group-types/update',
  'group-types/delete' => 'admin/group-types/delete',
  'group-types/view' => 'admin/group-types/view',
  'group-types/create' => 'admin/group-types/create',
  
  //super/users
  'users' => 'super/users',
  'users/update' => 'super/users/update',
  'users/view' => 'super/users/view',
  'users/delete' => 'super/users/delete',
  'users/changepass' => 'super/users/changepass',
  'users/create' => 'super/users/create',
  
   // super/groups
  'groups' => 'super/groups',
  'groups/update' => 'super/groups/update',
  'groups/delete' => 'super/groups/delete',
  'groups/view' => 'super/groups/view',
  'groups/create' => 'super/groups/create',
  'group-content' => 'super/groups/group-content',
  
  // super/students
  'students' => 'super/students',
  'students/update' => 'super/students/update',
  'students/delete' => 'super/students/delete',
  'students/view' => 'super/students/view',
  'students/create' => 'super/students/create',
  
  // super/teachers
  'teachers' => 'super/teachers',
  'teachers/update' => 'super/teachers/update',
  'teachers/delete' => 'super/teachers/delete',
  'teachers/view' => 'super/teachers/view',
  'teachers/create' => 'super/teachers/create',
  
  // super/lessons
  'lessons' => 'super/lessons',
  'lessons/update' => 'super/lessons/update',
  'lessons/delete' => 'super/lessons/delete',
  'lessons/view' => 'super/lessons/view',
  'lessons/create' => 'super/lessons/create',
  'lessons/results' => 'super/lessons/results',
  
  // super/students-in-lesson
    'students-in-lesson' => 'super/students-in-lesson',
  
  // super/buildings
  'buildings' => 'super/buildings',
  'buildings/update' => 'super/buildings/update',
  'buildings/delete' => 'super/buildings/delete',
  'buildings/view' => 'super/buildings/view',
  'buildings/create' => 'super/buildings/create',
  
  // super/subjects
  'subjects' => 'super/subjects',
  'subjects/update' => 'super/subjects/update',
  'subjects/delete' => 'super/subjects/delete',
  'subjects/view' => 'super/subjects/view',
  'subjects/create' => 'super/subjects/create',
  
  // super/group-types
  'group-types' => 'super/group-types',
  'group-types/update' => 'super/group-types/update',
  'group-types/delete' => 'super/group-types/delete',
  'group-types/view' => 'super/group-types/view',
  'group-types/create' => 'super/group-types/create',

   
 ];

