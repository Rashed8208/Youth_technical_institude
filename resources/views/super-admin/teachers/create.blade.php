<x-dashboard-shell 
    title="Add Teacher" 
    eyebrow="Teacher management" 
    description="Add a teaching staff member to the institute."
>

    <x-teacher-form 
        :action="route('super-admin.teachers.store')" 
        submit-label="Add teacher" 
    />

</x-dashboard-shell>