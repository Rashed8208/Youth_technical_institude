<x-dashboard-shell 
    title="Edit Teacher" 
    eyebrow="Teacher management" 
    description="Update the staff member's profile and assignment."
>

    <x-teacher-form 
        :teacher="$teacher"
        :action="route('super-admin.teachers.update', $teacher)"
        method="PUT"
        submit-label="Save changes"
    />

</x-dashboard-shell>