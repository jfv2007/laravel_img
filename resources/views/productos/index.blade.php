<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <!-- <h1>Aqui viene la tabla principal</h1>  -->

               <!-- Creacion del Boton-->
                <a type="button" href="{{ route('productos.create') }}" class="bg-indigo-500 px-12 py-2 rounded text-gray-200 font-semibold hover:bg-indigo-800 transition duration-200 each-in-out">Crear</a>

<!--                                   -->

<table class="table-fixed w-full" id="show_all_productos">
    <thead>
        <tr class="bg-gray-800 text-white">
            <th style="display: none;">ID</th>
            <th class="border px-4 py-2">NOMBRE</th>
            <th class="border px-4 py-2">DESCRIPCION</th>
            <th class="border px-4 py-2">IMAGEN</th>
            <th class="border px-4 py-2">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        <!--Traemos los datos de la tabla productos-->
        @foreach ($productos as $producto)
        <tr>
            <td style="display: none;">{{$producto->id}}</td>
            <td>{{$producto->nombre}}</td>
            <td>{{$producto->descripcion}}</td>
            <td  class="border px-14 py-1">
                <!--Se crea en la carpeta public la imagen-->
                <img src="/imagen/{{$producto->imagen}}" width="10%">
            </td>
            <td class="border px-4 py-2"> <!--Agrupamos los botones-->
                <div class="flex justify-center rounded-lg text-lg" role="group">
                    <!-- botón editar -->
                    <a href="{{ route('productos.edit', $producto->id) }}" class="rounded bg-gray-500 hover:bg-green-600 text-white font-bold py-2 px-4">Editar</a>

                    <!-- botón borrar -->
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="formEliminar">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded bg-gray-500 hover:bg-red-600 text-white font-bold py-2 px-4">Borrar</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
    <div>
        <!-- hacer la paginacion -->
        {!! $productos->links() !!}
    </div>
            </div>
        </div>
    </div>
    <script>

    $(document).ready(function() {
        $('#show_all_productos').DataTable({
            "lengthMenu": [[5,10, 50, -1], [5, 10, 50, "All"]]
        });
    } );
    </script>
</x-app-layout>
<script>

function () {
  'use strict'
  //debemos crear la clase formEliminar dentro del form del boton borrar
  //recordar que cada registro a eliminar esta contenido en un form
  var forms = document.querySelectorAll('.formEliminar')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
          event.preventDefault()
          event.stopPropagation()
          Swal.fire({
                title: '¿Confirma la eliminación del registro?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#20c997',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar'
            }).then((result) => {   //Confirma el submit al eliminar
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.','success');
                }
            })
      }, false)
    })
})()



</script>
