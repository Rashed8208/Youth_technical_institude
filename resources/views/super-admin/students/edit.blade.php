<x-dashboard-shell 
    title="Edit Student"
    eyebrow="Student management"
    description="Update the student profile, course, and result details."
>

    <x-student-form 
        :student="$student"
        :courses="$courses"
        :action="route('super-admin.students.update', $student)"
        method="PUT"
        submit-label="Save changes"
    />

</x-dashboard-shell>