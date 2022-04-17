<template>
  <div class="row">
    <div class="col-12">
      <button
        :disabled="file == null"
        class="btn btn-primary"
        @click="cargarArchivo()"
      >
        Cargar archivo
      </button>
      <input
        @change="handleChange($event)"
        type="file"
        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
        name=""
        id=""
        ref="inputupload"
      />
    </div>
    <div class="col-12">
      <data-table :items="items" :columns="headers"></data-table>
    </div>
  </div>
</template>

<script>
//Si/No		ID de transacción	Requerimiento fuente	Nombre del usuario:	Número móvil del Emisor	Número móvil de destinatario	Número de Identificación del Cliente	Clase de servicio	Servicio	Sub-servicio	Transferencia Fecha Hora	Monto del requerimiento	Monto del credito	Bono	Honorarios de procesamiento
const headers = [
  {
    name: "KEY",
    value: "key",
  },
  {
    name: "ID de transacción",
    value: "idTransacción",
  },
  {
    name: "Requerimiento fuente",
    value: "requerimientoFuente",
  },
  {
    name: "Nombre del usuario:",
    value: "nombreUsuario",
  },
  {
    name: "Número móvil del Emisor",
    value: "celularEmisor",
  },
  {
    name: "Número móvil de destinatario",
    value: "celularDestinatario",
  },
  {
    name: "Número de Identificación del Cliente",
    value: "indentificaiconCliente",
  },
  {
    name: "Clase de servicio",
    value: "claseServicio",
  },
  {
    name: "Sub-servicio",
    value: "subServicio",
  },
  {
    name: "Transferencia Fecha Hora",
    value: "transferenciaFechaHora",
  },
  {
    name: "Monto del requerimiento",
    value: "montoRequerimiento",
  },
  {
    name: "Monto del credito",
    value: "montoCredito",
  },
  {
    name: "Bono",
    value: "bono",
  },
  {
    name: "Honorarios de procesamiento",
    value: "horariosProcesamiento",
  },
];
export default {
  data() {
    return {
      file: null,
      headers,
      items: [],
    };
  },
  methods: {
    handleChange($event) {
      const file = $event.target.files;
      console.log(file);
      if (file.length == 1) {
        this.file = file[0];
      }
    },
    loadData() {
      let data = {};
      axios
        .get(`/transferencias`, data)
        .then((response) => {
          this.items = response.data.data;
        })
        .catch((error) => console.error(error));
    },
    cargarArchivo() {
      let formData = new FormData();
      formData.append("file", this.file);
      axios
        .post(`/upload/csv`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.data.success) {
            this.loadData();
            this.$toastr.s("Se ha actualizado los cronogramas");
          } else {
            this.$toastr.e("Hubo un error");
          }
        })
        .catch((error) => console.error(error));
    },
  },
  mounted() {
    this.loadData();
  },
};
</script>

<style></style>
