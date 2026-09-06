<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Students List | BNYTI</title>

    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-7xl mx-auto">

    <!-- Header -->

    <div class="bg-green-700 text-white rounded-2xl shadow-lg p-6 mb-6">

        <h1 class="text-3xl font-black">
            Registered Students
        </h1>

        <p class="mt-2 text-green-100">
            Bangladesh National Youth Technical Institute
        </p>

    </div>

    <!-- Search -->

    <div class="bg-white rounded-2xl shadow p-6 mb-6">

        <form
            method="GET"
            action="{{ route('students.index') }}">

            <div class="flex flex-col md:flex-row gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Search by Student Name, Registration Number or Roll Number..."
                    class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-300" >
                <button
                    type="submit"
                    class="bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-400">
                    Search
                </button>

                @if(!empty($search))

                    <a
                        href="{{ route('students.index') }}"
                        class="bg-gray-700 text-white px-6 py-3 rounded-xl font-bold text-center" >
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Success Message -->

    @if(session('status'))

        <div class="bg-green-100 border border-green-300 text-green-700 rounded-xl p-4 mb-6">
            {{ session('status') }}
        </div>

    @endif
    <!-- Student Table -->

    <div class="bg-white rounded-2xl shadow p-6">

        <div class="overflow-x-auto">

            <table class="w-full border-collapse">

                <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 border">
                        #
                    </th>

                    <th class="p-3 border">
                        Img
                    </th>

                    <th class="p-3 border">
                        Edit
                    </th>

                    <th class="p-3 border">
                        Admit Card
                    </th>

                    <th class="p-3 border">
                        Registration Card
                    </th>

                    <th class="p-3 border">
                        Student ID
                    </th>

                    <th class="p-3 border">
                        Certificate
                    </th>

                    <th class="p-3 border">
                        Transcript
                    </th>

                    <th class="p-3 border">
                        Testimonial
                    </th>

                    <th class="p-3 border">
                        Results
                    </th>
                </tr>
                </thead>
                <tbody>

                @forelse($students as $student)
                    <tr class="hover:bg-gray-50">

                        <!-- Serial -->

                        <td class="p-3 border text-center font-bold">

                            {{ $loop->iteration }}

                        </td>

                        <!-- Student Image -->

                        <td class="p-3 border text-center">

                            <a href="{{ route('students.show', $student) }}">

                                @if($student->image_path)

                                    <img
                                        src="{{ asset('storage/'.$student->image_path) }}"
                                        alt="{{ $student->name }}"
                                        class="w-14 h-14 rounded-full object-cover mx-auto border-2 border-green-600 cursor-pointer hover:opacity-80" >

                                @else

                                    <div
                                        class="w-14 h-14 rounded-full bg-gray-200 flex items-center justify-center mx-auto text-xs text-gray-500" >
                                        No Image
                                    </div>
                              @endif
                            </a>
                        </td>

                        <!-- Edit -->

                        <td class="p-3 border text-center">
                            <a
                                href="{{ route('students.edit', $student) }}"
                                class="bg-orange-500 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-orange-600">
                                Edit
                            </a>
                        </td>

                        <!-- Admit Card -->

                        <td class="p-3 border text-center">
                            <a
                                href="{{ route('students.document', [$student, 'admit-card']) }}"
                                class="bg-green-600 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-green-700" >
                                Admit Card
                            </a>
                        </td>

                        <!-- Registration Card -->

                        <td class="p-3 border text-center">
                            <a
                                href="{{ route('students.document', [$student, 'registration-card']) }}"
                                class="bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-blue-700" >
                                Registration Card
                            </a>
                        </td>
                        <!-- Student ID -->

                        <td class="p-3 border text-center">
                            <a
                                href="{{ route('students.document', [$student, 'student-id']) }}"
                                class="bg-purple-600 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-purple-700" >
                                Student ID
                            </a>
                        </td>

                        <!-- Certificate -->
                        <td class="p-3 border text-center">

                            <a
                                href="{{ route('students.document', [$student, 'certificate']) }}"
                                class="bg-yellow-600 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-yellow-700" >
                                Certificate
                            </a>
                        </td>
                        <!-- Transcript -->
                        <td class="p-3 border text-center">
                            <a
                                href="{{ route('students.document', [$student, 'transcript']) }}"
                                class="bg-red-600 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-red-700">
                                Transcript
                            </a>
                        </td>
                        <!-- Testimonial -->
                        <td class="p-3 border text-center">

                            <a
                                href="{{ route('students.document', [$student, 'testimonial']) }}"
                                class="bg-gray-700 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-gray-800" >
                                Testimonial
                            </a>
                        </td>
                        <!-- Results -->
                        <td class="p-3 border text-center">
                            <a
                                href="{{ route('students.document', [$student, 'results']) }}"
                                class="bg-indigo-600 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-indigo-700">
                                Results
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td
                            colspan="10"
                            class="p-8 border text-center text-gray-500" >
                            @if(!empty($search))

                                No student found for:

                                <strong>
                                    {{ $search }}
                                </strong>
                            @else
                                No students found.
                            @endif
                        </td>
                    </tr>
                @endforelse
                </tbody>
        </table>
        </div>
    </div>
</div>
</body>
</html>