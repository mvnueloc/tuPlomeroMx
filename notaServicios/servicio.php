<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>tuPlomeroMx</title>
    <link rel="stylesheet" href="./css/style.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
      @layer utilities {
        .content-auto {
          content-visibility: auto;
        }
      }
    </style>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: "#0077C2",
              secundary: "#00619A",
              extra: "#48E845",
            },
            height: {
              "screen-minus-16": "calc(100vh - 8rem)",
            },
          },
        },
      };
    </script>
  </head>

  <body class="bg-primary md: h-screen">
    <div class="h-32 flex justify-center items-center">
      <h2 class="text-white text-5xl font-bold">Notas de servicio</h2>
    </div>

    <!-- contenedor de items -->

    <div class="flex justify-center items-center md:h-screen-minus-16">
      <section>
        <div class="container grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- item1 -->
          <div class="mb-4">
            <div class="bg-gray-200 p-6 rounded-xl w-full h-full">
              <h2 class="mb-6 text-2xl md:text-3xl font-bold">Servicios</h2>
              <div class="grid grid-cols-2 gap-4 w-full">
                <div
                  class="relative bg-gray-300 p-4 rounded-full flex items-center justify-center w-20 h-20 transform translate-y-12 translate-x-10"
                >
                  <img
                    src="icono.svg"
                    alt="Icono"
                    class="w-14 h-14 rounded-full"
                  />
                </div>
                <div
                  id="servicioCompletado1"
                  name="servicioCompletado1"
                  class="relative bg-gray-300 p-4 rounded-lg w-60 h-40 transform -translate-x-20"
                >
                  <span
                    class="absolute top-2 right-2 bg-extra text-white text-xs font-bold py-1 px-2 rounded"
                    >Completado</span
                  >
                </div>
                <div
                  class="relative bg-gray-300 p-4 rounded-full flex items-center justify-center w-20 h-20 transform translate-y-12 translate-x-10"
                >
                  <img
                    src="icono.svg"
                    alt="Icono"
                    class="w-12 h-12 rounded-full"
                  />
                </div>
                <div
                  id="servicioCompletado2"
                  name="servicioCompletado1"
                  class="relative bg-gray-300 p-4 rounded-lg w-60 h-40 transform -translate-x-20"
                >
                  <span
                    class="absolute top-2 right-2 bg-extra text-white text-xs font-bold py-1 px-2 rounded"
                    >Completado</span
                  >
                </div>
              </div>
            </div>
          </div>

          <!-- item2 -->
          <div class="w-full mb-4 space-y-4 h-full">
            <div class="bg-gray-200 p-6 rounded-xl w-full">
              <h2 class="mb-6 text-2xl md:text-3xl font-bold">
                Formulario de nota de servicio
              </h2>
              <form
                class="space-y-2 md:space-y-2"
                action="servicio_bd.php"
                method="POST"
              >
                <div>
                  <label
                    for="nombre"
                    class="mb-2 text-sm font-medium text-gray-900"
                    >Nombre</label
                  >
                  <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    required
                  />
                </div>
                <div class="flex mb-4">
                  <div class="mr-4">
                    <label
                      for="fecha"
                      class="block mb-1 text-sm font-medium text-gray-900"
                      >Fecha</label
                    >
                    <input
                      type="date"
                      id="fecha"
                      name="fecha"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                      min="2024-01-01"
                      max="2030-12-31"
                      required
                    />
                  </div>
                  <div>
                    <label
                      for="hora"
                      class="block mb-1 text-sm font-medium text-gray-900"
                      >Hora</label
                    >
                    <input
                      type="time"
                      id="hora"
                      name="hora"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                      required
                    />
                  </div>
                </div>
                <div>
                  <label
                    for="descripcion"
                    class="mb-2 text-sm font-medium text-gray-900"
                    >Descripción</label
                  >
                  <textarea
                    id="descripcion"
                    name="descripcion"
                    rows="5"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    placeholder="Ingrese la descripción"
                    required
                  ></textarea>
                </div>
                <div class="mt-4 flex justify-end">
                  <button
                    type="submit"
                    class="bg-secundary w-2/6 text-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center"
                  >
                    Subir
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- ITEM 3 -->

          <div class="md:col-span-2 h-full bg-gray-200 p-6 rounded-xl">
            <h2 class="mb-6 text-2xl md:text-3xl font-bold">
              Formulario de nota de servicio
            </h2>
            <div class="grid md:grid-cols-3">
              <div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 1</label
                  >
                </div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 2</label
                  >
                </div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 3</label
                  >
                </div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 4</label
                  >
                </div>
              </div>

              <div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 1</label
                  >
                </div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 2</label
                  >
                </div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 3</label
                  >
                </div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 4</label
                  >
                </div>
              </div>

              <div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 1</label
                  >
                </div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 2</label
                  >
                </div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 3</label
                  >
                </div>
                <div class="flex items-center mb-4">
                  <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                  />
                  <label
                    for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900"
                    >Refaccion tipo 4</label
                  >
                </div>
              </div>
            </div>
          </div>

          <!-- item3 -->
          <!--<div class="w-full md:w-auto">-->
          <!-- <div class="mt-4 w-full h-full">
            <div class="bg-gray-200 p-6 rounded-xl w-full">
              <h2 class="mb-6 text-2xl md:text-3xl font-bold">
                Vale de refacciones
              </h2>
              <div class="grid grid-cols-1 gap-4">
                <div
                  id="descripcionVale"
                  name="descripcionVale"
                  class="bg-gray-300 p-4 rounded-lg flex items-center justify-center w-full h-40"
                ></div>
              </div>
            </div>
          </div> -->
        </div>
      </section>
    </div>
  </body>
</html>
