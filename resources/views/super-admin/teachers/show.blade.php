<x-dashboard-shell 
    :title="$teacher->name"
    eyebrow="Teacher profile"
    :description="$teacher->designation.' · '.$teacher->employee_number"
>

    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">


        <dl class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">


            <div>

                <dt class="text-xs font-black uppercase text-slate-500">
                    Phone
                </dt>

                <dd class="mt-2 font-black">
                    {{ $teacher->phone }}
                </dd>

            </div>


            <div>

                <dt class="text-xs font-black uppercase text-slate-500">
                    Department
                </dt>

                <dd class="mt-2 font-black">
                    {{ $teacher->department ?? '—' }}
                </dd>

            </div>


            <div>

                <dt class="text-xs font-black uppercase text-slate-500">
                    Status
                </dt>

                <dd class="mt-2 font-black">
                    {{ $teacher->is_active ? 'Active' : 'Inactive' }}
                </dd>

            </div>


        </dl>



        <section class="mt-8 rounded-2xl bg-slate-50 p-5">


            <h2 class="text-xs font-black uppercase tracking-wide text-slate-500">
                Public description
            </h2>


            <p class="mt-2 whitespace-pre-line leading-7 text-slate-700">
                {{ $teacher->description ?: 'No description has been added yet.' }}
            </p>


        </section>



        <div class="mt-8 flex gap-3">


            <a 
                href="{{ route('super-admin.teachers.edit', $teacher) }}"
                class="rounded-full bg-emerald-700 px-5 py-3 font-black text-white"
            >
                Edit teacher
            </a>



            <form method="POST" action="{{ route('super-admin.teachers.destroy', $teacher) }}">

                @csrf

                @method('DELETE')


                <button class="rounded-full border border-rose-300 px-5 py-3 font-black text-rose-700">
                    Delete
                </button>


            </form>


        </div>


    </article>


</x-dashboard-shell>