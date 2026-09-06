<x-dashboard-shell 
    title="Teachers" 
    eyebrow="People & Branches" 
    description="Maintain accurate contact, employment, and teaching information for institute staff."
>

    <x-slot:actions>
        <a 
            href="{{ route('super-admin.teachers.create') }}" 
            class="admin-button admin-button--primary"
        >
            Add a teacher
        </a>
    </x-slot:actions>


    <form method="GET" class="admin-panel mb-5 flex gap-3">

        <label class="flex-1">

            <span class="sr-only">
                Search teachers
            </span>

            <input 
                name="search"
                value="{{ $search }}"
                placeholder="Search by name, employee number, or designation"
                class="min-h-11 w-full rounded-xl border border-slate-300 px-4 text-sm"
            >

        </label>


        <button class="admin-button admin-button--primary">
            Search
        </button>


        @if($search)

            <a 
                href="{{ route('super-admin.teachers.index') }}"
                class="admin-button admin-button--secondary"
            >
                Clear
            </a>

        @endif

    </form>



    @if($teachers->isEmpty())


        <div class="admin-panel">

            <x-admin-empty-state 
                title="No teachers found"
                description="Add the first teacher or clear your search to see all staff records."
                action-label="Add a teacher"
                :action-url="route('super-admin.teachers.create')" 
            />

        </div>



    @else


        <div class="admin-table-wrap">

            <div class="overflow-x-auto">

                <table class="admin-table">


                    <caption class="sr-only">
                        Teaching staff
                    </caption>


                    <thead>

                        <tr>

                            <th>
                                Teacher
                            </th>

                            <th>
                                Employee number
                            </th>

                            <th>
                                Designation
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-right">
                                Next step
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                    @foreach($teachers as $teacher)


                        <tr>


                            <td class="font-black text-slate-950">
                                {{ $teacher->name }}
                            </td>


                            <td class="text-sm text-slate-700">
                                {{ $teacher->employee_number }}
                            </td>


                            <td class="text-sm text-slate-600">
                                {{ $teacher->designation }}
                            </td>


                            <td class="text-sm text-slate-600">
                                {{ $teacher->department ?: 'Not assigned' }}
                            </td>


                            <td>

                                <x-admin-status 
                                    :status="$teacher->is_active ? 'active' : 'inactive'" 
                                />

                            </td>


                            <td class="text-right">

                                <a 
                                    href="{{ route('super-admin.teachers.show', $teacher) }}"
                                    class="admin-button admin-button--secondary"
                                >
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

            {{ $teachers->links() }}

        </div>


    @endif


</x-dashboard-shell>