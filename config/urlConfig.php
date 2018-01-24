<?php

 /**
  * Url router rules
 */

return [
  'login' => 'site/login',
  'admin' => 'admin/personal',
  // admin/users
  'users' => 'admin/users',
  'users/update' => 'admin/users/update',
  'users/view' => 'admin/users/view',
  'users/delete' => 'admin/users/delete',
  'users/changepass' => 'admin/users/changepass',
  'users/create' => 'admin/users/create',
  
   // admin/groups
  'groups' => 'admin/groups',
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
 ];

