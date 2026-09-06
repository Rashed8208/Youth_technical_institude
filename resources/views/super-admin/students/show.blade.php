<x-dashboard-shell 
    :title="$student->name"
    eyebrow="Student profile"
    :description="($student->registration_number ?? 'Student record').' · '.$student->course->name"
>

    <div class="grid gap-6 lg:grid-cols-3">


        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">


            <div class="flex flex-wrap items-start justify-between gap-5 border-b border-slate-100 pb-6">


                <div class="flex items-center gap-4">


                    @if ($student->image_path)

                        <img 
                            src="{{ Storage::disk('public')->url($student->image_path) }}"
                            alt="Photo of {{ $student->name }}"
                            class="size-20 rounded-2xl object-cover"
                        >

                    @endif



                    <div>

                        <p class="text-xl font-black text-slate-950">
                            {{ $student->name }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $student->registration_number ?? 'Registration number pending' }}
                        </p>

                    </div>


                </div>



                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-black text-emerald-700">
                    {{ $student->result_status }}
                </span>


            </div>




            <dl class="mt-6 grid gap-6 sm:grid-cols-2">


                @foreach ([
                    "father_name" => "Father's name",
                    "mother_name" => "Mother's name",
                    'gender' => 'Sex',
                    'phone' => 'Phone number',
                    'passport_nid_number' => 'Passport / NID',
                    'education_qualification' => 'Education qualification',
                    'course.name' => 'Department',
                    'duration' => 'Duration',
                    'session' => 'Session',
                    'district' => 'District',
                    'upazila' => 'Upazila',
                    'date_of_birth' => 'Date of birth',
                    'admitted_at' => 'Join date',
                    'expire_date' => 'Expire date'
                ] as $field => $label)


                    @php(
                        $value = str_contains($field, '.')
                        ? data_get($student, $field)
                        : $student->{$field}
                    )


                    <div>

                        <dt class="text-xs font-black uppercase tracking-wide text-slate-500">
                            {{ $label }}
                        </dt>


                        <dd class="mt-2 font-bold text-slate-900">

                            {{ 
                                $value instanceof \Carbon\CarbonInterface
                                ? $value->format('d M Y')
                                : ($value ?: '—')
                            }}

                        </dd>

                    </div>


                @endforeach


            </dl>




            <div class="mt-6">

                <dt class="text-xs font-black uppercase tracking-wide text-slate-500">
                    Full address
                </dt>


                <dd class="mt-2 leading-7 text-slate-700">
                    {{ $student->address ?: '—' }}
                </dd>


            </div>




            <div class="mt-8 flex flex-wrap gap-3">


                <a 
                    href="{{ route('super-admin.students.edit', $student) }}"
                    class="rounded-full bg-emerald-700 px-5 py-3 font-black text-white"
                >
                    Edit student
                </a>



                <form method="POST" action="{{ route('super-admin.students.destroy', $student) }}">

                    @csrf

                    @method('DELETE')


                    <button class="rounded-full border border-rose-300 px-5 py-3 font-black text-rose-700">
                        Delete
                    </button>


                </form>


            </div>


        </article>





        <aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">


            <p class="text-xs font-black uppercase tracking-[.14em] text-emerald-700">
                Academic Records
            </p>



            <div class="mt-4 grid gap-2">


                <a 
                    href="{{ route('super-admin.students.semester-enrollments.index', $student) }}"
                    class="rounded-xl bg-emerald-50 px-4 py-3 text-sm font-black text-emerald-700 hover:bg-emerald-100"
                >
                    Assign semesters & subjects
                </a>



                <a 
                    href="{{ route('super-admin.students.results.index', $student) }}"
                    class="rounded-xl bg-blue-50 px-4 py-3 text-sm font-black text-blue-700 hover:bg-blue-100"
                >
                    Manage result sheets
                </a>



                @foreach([
                    'admit-card' => 'Admit Card',
                    'registration-card' => 'Registration Card',
                    'student-id' => 'Student ID',
                    'certificate' => 'Certificate',
                    'testimonial' => 'Testimonial',
                    'transcript' => 'Transcript',
                    'forwarding-letter' => 'Forwarding Letter',
                    'results' => 'Legacy Results'
                ] as $document => $label)


                    <a 
                        href="{{ route('super-admin.students.documents.show', [$student, $document]) }}"
                        class="rounded-xl bg-slate-50 px-4 py-3 text-sm font-black text-slate-700 hover:bg-emerald-50 hover:text-emerald-800"
                    >
                        {{ $label }}
                    </a>


                @endforeach


            </div>


        </aside>


    </div>


</x-dashboard-shell>