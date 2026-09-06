<x-dashboard-shell 
    title="Add Student"
    eyebrow="Student management"
    description="Register a new student and capture their academic details."
>

    <x-student-form 
        :courses="$courses"
        :action="route('super-admin.students.store')"
        submit-label="Add student"
    />

</x-dashboard-shell>