    <x-dashboard-shell 
        title="Students" 
        eyebrow="People & Branches" 
        description="Find student records, update their details, enter results, and prepare official documents.">

        <x-slot:actions>
            <a href="{{ route('super-admin.students.create') }}" class="admin-button admin-button--primary">
                Register a student
            </a>
        </x-slot:actions>


        <form method="GET" class="admin-panel mb-5 flex gap-3">

            <label class="flex-1">
                <span class="sr-only">Search students</span>

                <input 
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search by name, registration number, or roll"
                    class="min-h-11 w-full rounded-xl border border-slate-300 px-4 text-sm" >
            
            </label>
            <button class="admin-button admin-button--primary">
                Search
            </button>
            @if($search)
                <a 
                    href="{{ route('super-admin.students.index') }}" 
                    class="admin-button admin-button--secondary"
                >
                    Clear
                </a>
            @endif

        </form>

        @if($students->isEmpty())

            <div class="admin-panel">
                <x-admin-empty-state 
                    title="No students found"
                    description="Register the first student or clear your search to see all records."
                    action-label="Register a student"
                    :action-url="route('super-admin.students.create')" 
                />
            </div>
        @else
            <div class="admin-table-wrap">

                <div class="overflow-x-auto">

                    <table class="admin-table">

                        <caption class="sr-only">
                            Registered students
                        </caption>
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Registration</th>
                                <th>Course</th>
                                <th>Result status</th>
                                <th class="text-right">
                                    Next step
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($students as $student)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">

                                        @if($student->image_path)

                                            <img 
                                                src="{{ Storage::disk('public')->url($student->image_path) }}"
                                                alt=""
                                                class="size-11 rounded-full object-cover"  >
                                        @else
                                            <span class="grid size-11 place-items-center rounded-full bg-slate-100 text-xs font-black text-slate-500">
                                                {{ Str::of($student->name)->substr(0, 1) }}
                                            </span>
                                        @endif
                                        <div>
                                            <p class="font-black text-slate-950">
                                                {{ $student->name }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                Roll: {{ $student->roll_number ?: 'Not assigned' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm font-semibold text-slate-700">
                                    {{ $student->registration_number }}
                                </td>
                                <td class="text-sm text-slate-600">
                                    {{ $student->course?->name ?? 'Not assigned' }}
                                </td>
                                <td>
                                    <x-admin-status :status="$student->result_status" />
                                </td>
                                <td class="text-right">
                                    <a 
                                        href="{{ route('super-admin.students.show', $student) }}"
                                        class="admin-button admin-button--secondary"  >
                                        Open record
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6">
                {{ $students->links() }}
            </div>
        @endif
    </x-dashboard-shell>