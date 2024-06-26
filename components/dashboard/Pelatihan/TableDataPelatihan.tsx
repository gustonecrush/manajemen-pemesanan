import React, { ReactElement, useState } from "react";
import TableData from "../Tables/TableData";
import {
  RiRadioButtonLine,
  RiShipLine,
  RiVerifiedBadgeFill,
} from "react-icons/ri";

import {
  Sheet,
  SheetClose,
  SheetContent,
  SheetDescription,
  SheetFooter,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from "@/components/ui/sheet";
import {
  ColumnDef,
  ColumnFiltersState,
  SortingState,
  VisibilityState,
  getCoreRowModel,
  getFilteredRowModel,
  getPaginationRowModel,
  getSortedRowModel,
  useReactTable,
} from "@tanstack/react-table";
import {
  ArrowUpDown,
  Edit3Icon,
  Fullscreen,
  LucideClipboardEdit,
  LucideNewspaper,
  LucidePrinter,
  Trash,
  X,
} from "lucide-react";
import { Button } from "@/components/ui/button";
import { HiMiniUserGroup, HiUserGroup } from "react-icons/hi2";
import {
  TbBook,
  TbBookFilled,
  TbBroadcast,
  TbBuildingCommunity,
  TbCalendarCheck,
  TbCalendarDot,
  TbCalendarExclamation,
  TbCalendarSearch,
  TbCalendarStats,
  TbChartBubble,
  TbChartDonut,
  TbDatabase,
  TbDatabaseEdit,
  TbFileCertificate,
  TbFileDigit,
  TbFileInvoice,
  TbFishChristianity,
  TbMoneybag,
  TbQrcode,
  TbSchool,
  TbShoppingCart,
  TbTargetArrow,
} from "react-icons/tb";
import {
  IoIosBook,
  IoIosInformationCircle,
  IoLogoDropbox,
  IoMdBook,
  IoMdGlobe,
} from "react-icons/io";
import { FiEdit, FiUploadCloud } from "react-icons/fi";
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import { useRouter } from "next/navigation";
import { MdOutlineSaveAlt } from "react-icons/md";
import FormPelatihan from "../admin/formPelatihan";
import Toast from "@/components/toast";
import SertifikatSettingPage1 from "@/components/sertifikat/sertifikatSettingPage1";
import SertifikatSettingPage2 from "@/components/sertifikat/sertifikatSettingPage2";
import { PiMicrosoftExcelLogoFill, PiStampLight } from "react-icons/pi";
import Image from "next/image";
import axios, { AxiosResponse } from "axios";
import { Checkbox } from "@/components/ui/checkbox";
import { PelatihanMasyarakat } from "@/types/product";
import {
  FaBookOpen,
  FaBoxOpen,
  FaPaperPlane,
  FaRupiahSign,
} from "react-icons/fa6";
import { Input } from "@/components/ui/input";
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { convertDate } from "@/utils";
import Cookies from "js-cookie";
import { LemdiklatDetailInfo } from "@/types/lemdiklat";
import { Progress } from "@/components/ui/progress";
import { GiBookmarklet } from "react-icons/gi";
import { DialogSertifikatPelatihan } from "@/components/sertifikat/dialogSertifikatPelatihan";
import { DialogTemplateSertifikatPelatihan } from "@/components/sertifikat/dialogTemplateSertifikatPelatihan";
import Link from "next/link";
import { Barang, Pemesanan } from "@/types/pemesanan";

const TableDataPelatihan: React.FC = () => {
  const [showFormAjukanPelatihan, setShowFormAjukanPelatihan] =
    React.useState<boolean>(false);
  const [showCertificateSetting, setShowCertificateSetting] =
    React.useState<boolean>(false);

  const baseUrl = process.env.NEXT_PUBLIC_BASE_URL;

  const [isFetching, setIsFetching] = React.useState<boolean>(false);

  const [data, setData] = React.useState<Pemesanan[]>([]);
  const handleFetchingDataPemesanan = async () => {
    try {
      const response: AxiosResponse = await axios.get(
        `${baseUrl}/api/pemesanans`
      );
      setData(response.data);
      console.log("FETCHCING DATA PEMESANAN : ", response);
    } catch (error) {
      console.error("ERROR FETCHING DATA PEMESANAN : ", error);
      throw error;
    }
  };

  const [namaPemesanan, setNamaPemesanan] = React.useState<string>("");
  const [tanggalPemesanan, setTanggalPemesanan] = React.useState<string>("");
  const [unitPemesanan, setUnitPemesanan] = React.useState<string>("");
  const [detailPemesanan, setDetailPemesanan] = React.useState<string>("");
  const [pemesan, setPemesan] = React.useState<string>("");

  const handleUploadDataPemesanan = async (e: any) => {
    const userId = Cookies.get("XSRF098888");

    const data = new FormData();
    data.append("user_id", userId!);
    data.append("pemesanan", namaPemesanan);
    data.append("detail_pemesanan", detailPemesanan);
    data.append("tanggal_pemesanan", tanggalPemesanan);
    data.append("unit", unitPemesanan);
    data.append("pemesan", pemesan);

    try {
      const response = await axios.post(`${baseUrl}/api/pemesanans`, data);
      console.log("UPLOAD DATA PEMESANAN : ", response);
      Toast.fire({
        icon: "success",
        title: `Sukses menambahkan data pemesanan!`,
      });
      setIsOpenFormMateri(!isOpenFormMateri);
      handleFetchingDataPemesanan();
    } catch (error) {
      console.error("ERROR UPLOAD DATA PEMESANAN : ", error);
      Toast.fire({
        icon: "error",
        title: `Gagal menambahkan data pemesanan, harap coba lagi nanti!`,
      });
      setIsOpenFormMateri(!isOpenFormMateri);
      handleFetchingDataPemesanan();
      throw error;
    }
  };

  const handleDeleteDataPemesanan = async (e: any, id: number) => {
    e.preventDefault();

    try {
      const response = await axios.delete(`${baseUrl}/api/pemesanans/${id}`);
      console.log("DELETE DATA PEMESANAN : ", response);
      Toast.fire({
        icon: "success",
        title: `Sukses menghapus data pemesanan!`,
      });
      handleFetchingDataPemesanan();
    } catch (error) {
      console.error("ERROR DELETE DATA PEMESANAN : ", error);
      Toast.fire({
        icon: "error",
        title: `Gagal menghapus data pemesanan, harap coba lagi nanti!`,
      });
      handleFetchingDataPemesanan();
      throw error;
    }
  };

  const [idSelectedPemesananUpdate, setIdSelectedPemesananUpdate] =
    React.useState<number>(0);
  const [isUpdate, setIsUpdate] = React.useState<boolean>(false);
  const handleOpenFormUpdatePemesanan = async (e: any, id: number) => {
    e.preventDefault();
    setIdSelectedPemesananUpdate(id);
    setIsUpdate(!isUpdate);
    try {
      const response: AxiosResponse = await axios.get(
        `${baseUrl}/api/pemesanans/${id}`
      );
      setNamaPemesanan(response.data.pemesanan);
      setDetailPemesanan(response.data.detail_pemesanan);
      setTanggalPemesanan(response.data.tanggal_pemesanan);
      setUnitPemesanan(response.data.unit);
      setPemesan(response.data.pemesan);
      setIsOpenFormMateri(!isOpenFormMateri);
    } catch (error) {
      console.error("ERROR GET BY ID PEMESANAN : ", error);
      Toast.fire({
        icon: "error",
        title: `Data tidak ditemukan!`,
      });
      setIsUpdate(false);
    }
  };

  const handleUpdateDataPemesanan = async (e: any) => {
    const userId = Cookies.get("XSRF098888");

    const data = new FormData();
    data.append("user_id", userId!);
    data.append("pemesanan", namaPemesanan);
    data.append("detail_pemesanan", detailPemesanan);
    data.append("tanggal_pemesanan", tanggalPemesanan);
    data.append("unit", unitPemesanan);
    data.append("pemesan", pemesan);

    try {
      const response = await axios.post(
        `${baseUrl}/api/pemesanans/${idSelectedPemesananUpdate}`,
        data
      );
      console.log("UPDATE DATA PEMESANAN : ", response);
      Toast.fire({
        icon: "success",
        title: `Sukses mengupdate data pemesanan!`,
      });
      setIsOpenFormMateri(!isOpenFormMateri);
      handleFetchingDataPemesanan();
      setIsUpdate(false);
      setNamaPemesanan("");
      setTanggalPemesanan("");
      setDetailPemesanan("");
      setPemesan("");
      setUnitPemesanan("");
      setIdSelectedPemesananUpdate(0);
    } catch (error) {
      console.error("ERROR UPLOAD DATA PEMESANAN : ", error);
      Toast.fire({
        icon: "error",
        title: `Gagal megupdate data pemesanan, harap coba lagi nanti!`,
      });
      setIsOpenFormMateri(!isOpenFormMateri);
      handleFetchingDataPemesanan();
      setIsUpdate(false);
      setNamaPemesanan("");
      setTanggalPemesanan("");
      setDetailPemesanan("");
      setPemesan("");
      setUnitPemesanan("");
      setIdSelectedPemesananUpdate(0);
      throw error;
    }
  };

  const [dataBarang, setDataBarang] = React.useState<Barang[]>([]);
  const handleFetchingDataBarang = async () => {
    try {
      const response: AxiosResponse = await axios.get(`${baseUrl}/api/barangs`);
      setDataBarang(response.data);
      console.log("FETCHCING DATA BARANG : ", response);
    } catch (error) {
      console.error("ERROR FETCHING DATA BARANG : ", error);
      throw error;
    }
  };

  const [isOpenFormMateri, setIsOpenFormMateri] =
    React.useState<boolean>(false);
  const [selectedId, setSelectedId] = React.useState<number>(0);

  const [sorting, setSorting] = React.useState<SortingState>([]);
  const [columnFilters, setColumnFilters] = React.useState<ColumnFiltersState>(
    []
  );

  const [sertifikatUntukPelatihan, setSertifikatUntukPelatihan] =
    React.useState("");
  const [ttdSertifikat, setTtdSertifikat] = React.useState("");
  const [openFormSertifikat, setOpenFormSertifikat] = React.useState(false);

  const [isOpenFormPublishedPelatihan, setIsOpenFormPublishedPelatihan] =
    React.useState<boolean>(false);

  const router = useRouter();
  const [columnVisibility, setColumnVisibility] =
    React.useState<VisibilityState>({});
  const [rowSelection, setRowSelection] = React.useState({});
  const columns: ColumnDef<Pemesanan>[] = [
    {
      accessorKey: "id",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            className={`text-gray-900 font-semibold`}
            onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
          >
            No
            <ArrowUpDown className="ml-1 h-4 w-4" />
          </Button>
        );
      },
      cell: ({ row }) => (
        <div className={`text-center uppercase`}>{row.index + 1}</div>
      ),
    },
    {
      accessorKey: "IdPelatihan",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            className={`w-fit ml-8 text-gray-900 font-semibold`}
            onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
          >
            Action
            <TbDatabaseEdit className="ml-1 h-4 w-4" />
          </Button>
        );
      },
      cell: ({ row }) => (
        <div className="flex w-fit flex-col gap-2">
          <div className={`${"flex"} flex items-center justify-center gap-1`}>
            <Button
              variant="outline"
              onClick={(e) => {
                setSelectedId(row.original.id);
                setIsOpenBarangPesanan(!isOpenBarangPesanan);
              }}
              className="ml-auto border border-[#000000] relative"
            >
              {row.original.barangs.length > 0 && (
                <div className="span bg-rose-500 rounded-full w-4 h-4 p-3 flex items-center justify-center text-white absolute -top-2 -right-2">
                  {row.original.barangs.length}
                </div>
              )}

              <FaBoxOpen className="h-4 w-4" />
            </Button>

            <Button
              variant="outline"
              onClick={(e) => handleOpenFormUpdatePemesanan(e, row.original.id)}
              className="ml-auto border border-yellow-400"
            >
              <Edit3Icon className="h-4 w-4 text-yellow-400" />
            </Button>

            <AlertDialog>
              <AlertDialogTrigger asChild>
                <Button
                  variant="outline"
                  className="ml-auto border border-rose-600"
                >
                  <Trash className="h-4 w-4 text-rose-600" />
                </Button>
              </AlertDialogTrigger>
              <AlertDialogContent>
                <AlertDialogHeader>
                  <AlertDialogTitle>
                    Apakah kamu yakin menghapus data pemesanan ini?
                  </AlertDialogTitle>
                  <AlertDialogDescription>
                    Penghapusan data ini akan dilakukan secara permanen,
                    sehingga anda tidak dapat kembali melakukan undo terkait
                    tindakan ini!
                  </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                  <AlertDialogCancel>Batal</AlertDialogCancel>
                  <AlertDialogAction
                    onClick={(e) =>
                      handleDeleteDataPemesanan(e, row.original.id)
                    }
                    className="bg-rose-600"
                  >
                    Hapus
                  </AlertDialogAction>
                </AlertDialogFooter>
              </AlertDialogContent>
            </AlertDialog>

            <Button
              variant="outline"
              onClick={(e) => {
                if (row.original.barangs.length == 0) {
                  Toast.fire({
                    icon: "error",
                    title: `Kamu belum mengentry data barang yang akan dipesan`,
                  });
                }
              }}
              className="ml-auto border border-blue-500"
            >
              <FaPaperPlane className="h-4 w-4 text-blue-500" />
            </Button>
          </div>
        </div>
      ),
    },
    {
      accessorKey: "pemesanan",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            className={`p-0 !text-left w-[270px] flex items-center justify-start text-gray-900 font-semibold`}
            onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
          >
            Pemesanan
            <TbShoppingCart className="ml-1 h-4 w-4" />
          </Button>
        );
      },
      cell: ({ row }) => (
        <div className={`text-left capitalize`}>
          <p className="text-base font-semibold tracking-tight leading-none">
            {row.original.pemesanan}
          </p>

          <p className="text-xs text-gray-400 mt-1 leading-[100%] mb-1">
            {row.original.detail_pemesanan}
          </p>
        </div>
      ),
    },
    {
      accessorKey: "tanggal_pemesanan",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            className={`p-0 !text-left w-[270px] flex items-center justify-start text-gray-900 font-semibold`}
            onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
          >
            Tanggal Pemesanan
            <TbCalendarStats className="ml-1 h-4 w-4" />
          </Button>
        );
      },
      cell: ({ row }) => (
        <div className={`text-left`}>
          <p className="text-base font-semibold tracking-tight leading-none">
            Dipesan oleh {row.original.pemesan}
          </p>
          <p className="text-xs text-gray-400 mt-1 leading-[100%] mb-1">
            Pada tanggal {row.original.tanggal_pemesanan}
          </p>
        </div>
      ),
    },
    {
      accessorKey: "unit_pemesanan",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            className={`p-0 !text-left w-[270px] flex items-center justify-start text-gray-900 font-semibold`}
            onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
          >
            Unit
            <IoLogoDropbox className="ml-1 h-4 w-4" />
          </Button>
        );
      },
      cell: ({ row }) => (
        <div className={`text-left capitalize`}>
          <p className="text-base font-semibold tracking-tight leading-none">
            {row.original.unit} Unit
          </p>
        </div>
      ),
    },
  ];

  const table = useReactTable({
    data,
    columns,
    onSortingChange: setSorting,
    onColumnFiltersChange: setColumnFilters,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    onColumnVisibilityChange: setColumnVisibility,
    onRowSelectionChange: setRowSelection,
    state: {
      sorting,
      columnFilters,
      columnVisibility,
      rowSelection,
    },
  });

  React.useEffect(() => {
    handleFetchingDataPemesanan();
    handleFetchingDataBarang();
  }, []);

  const [isOpenBarangPesanan, setIsOpenBarangPesanan] =
    React.useState<boolean>(false);

  const [barangPesanan, setBarangPesanan] = React.useState<string>("");
  const [selectedBarang, setSelectedBarang] = React.useState<string>("");
  const [kuantitasPemesanan, setKuantitasPemesanan] =
    React.useState<string>("");
  const handleUploadDataBarangPemesanan = async (e: any) => {
    const userId = Cookies.get("XSRF098888");

    const data = new FormData();
    data.append("id_pemesanan", selectedId.toString());
    data.append("id_barang", barangPesanan);
    data.append("kuantitas", kuantitasPemesanan);

    try {
      const response = await axios.post(
        `${baseUrl}/api/barang-pemesanans`,
        data
      );
      console.log("UPLOAD DATA BARANG PEMESANAN : ", response);
      Toast.fire({
        icon: "success",
        title: `Sukses menambahkan data barang pesanan!`,
      });
      setIsOpenBarangPesanan(!isOpenBarangPesanan);
      setSelectedId(0);
      setBarangPesanan("");
      setKuantitasPemesanan("");
      handleFetchingDataPemesanan();
    } catch (error) {
      console.error("ERROR UPLOAD DATA BARANG PEMESANAN : ", error);
      Toast.fire({
        icon: "error",
        title: `Gagal menambahkan data barang pesanan, harap coba lagi nanti!`,
      });
      setIsOpenBarangPesanan(!isOpenBarangPesanan);
      setSelectedId(0);
      setBarangPesanan("");
      setKuantitasPemesanan("");
      handleFetchingDataPemesanan();
      throw error;
    }
  };

  return (
    <div className="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default  sm:px-7.5 xl:col-span-8">
      <AlertDialog open={isOpenFormMateri}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle className="flex items-center gap-2">
              {" "}
              <TbShoppingCart className="h-4 w-4" />
              {isUpdate ? "Update Data Pemesanan" : "Tambah Data Pemesanan"}
            </AlertDialogTitle>
            <AlertDialogDescription className="-mt-10">
              {isUpdate ? "Update" : "Tambahkan"} data pemesanan-mu segera
              sekarang agar terlist riwayat pemesanan yang masuk ke CV!
            </AlertDialogDescription>
          </AlertDialogHeader>
          <fieldset>
            <form autoComplete="off">
              <div className="flex flex-wrap mb-1 w-full">
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Pemesanan <span className="text-red-600">*</span>
                  </label>
                  <input
                    id="pemesanan"
                    type="text"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder={
                      isUpdate ? namaPemesanan : "Masukkan judul pemesanan"
                    }
                    required
                    value={namaPemesanan}
                    onChange={(e) => setNamaPemesanan(e.target.value)}
                  />
                </div>
              </div>

              <div className="flex mb-1 gap-2 w-full">
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Tanggal Pemesanan <span className="text-red-600">*</span>
                  </label>
                  <input
                    id="tanggal_pemesanan"
                    type="date"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder="Masukkan nama materi"
                    required
                    value={tanggalPemesanan}
                    onChange={(e) => setTanggalPemesanan(e.target.value)}
                  />
                </div>
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Pemesan <span className="text-red-600">*</span>
                  </label>
                  <input
                    id="pemesan"
                    type="text"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder={isUpdate ? pemesan : "Masukkan nama pemesan"}
                    required
                    value={pemesan}
                    onChange={(e) => setPemesan(e.target.value)}
                  />
                </div>
              </div>

              <div className="flex flex-wrap mb-1 w-full">
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Unit <span className="text-red-600">*</span>
                  </label>
                  <input
                    id="unit"
                    type="number"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder={
                      isUpdate ? unitPemesanan.toString() : "Masukkan unit"
                    }
                    required
                    value={unitPemesanan}
                    onChange={(e) => setUnitPemesanan(e.target.value)}
                  />
                </div>
              </div>

              <div className="flex flex-wrap mb-1 w-full">
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Detail Pemesanan <span className="text-red-600">*</span>
                  </label>
                  <textarea
                    rows={7}
                    id="detail_pemesanan"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder={
                      isUpdate ? detailPemesanan : "Masukkan detail pemesanan"
                    }
                    required
                    value={detailPemesanan}
                    onChange={(e) => setDetailPemesanan(e.target.value)}
                  />
                </div>
              </div>

              <AlertDialogFooter className="mt-3">
                <AlertDialogCancel
                  onClick={(e) => {
                    if (isUpdate) {
                      setIsUpdate(!isUpdate);
                      setNamaPemesanan("");
                      setTanggalPemesanan("");
                      setDetailPemesanan("");
                      setPemesan("");
                      setUnitPemesanan("");
                      setIdSelectedPemesananUpdate(0);
                      setIsOpenFormMateri(!isOpenFormMateri);
                    } else {
                      setIsUpdate(!isUpdate);
                      setIsOpenFormMateri(!isOpenFormMateri);
                    }
                  }}
                >
                  Cancel
                </AlertDialogCancel>
                <AlertDialogAction
                  onClick={(e) => {
                    isUpdate
                      ? handleUpdateDataPemesanan(e)
                      : handleUploadDataPemesanan(e);
                  }}
                >
                  {isUpdate ? "Update" : "Upload"}
                </AlertDialogAction>
              </AlertDialogFooter>
            </form>
          </fieldset>
        </AlertDialogContent>
      </AlertDialog>

      <AlertDialog open={isOpenBarangPesanan}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle className="flex items-center gap-2">
              {" "}
              <FaBoxOpen className="h-4 w-4" />
              Tambah Barang Pesanan
            </AlertDialogTitle>
            <AlertDialogDescription className="-mt-10">
              Tambahkan data barang pesanan segera sekarang agar terlist riwayat
              pemesanan yang masuk ke CV!
            </AlertDialogDescription>
          </AlertDialogHeader>
          <fieldset>
            <form autoComplete="off">
              <div className="flex flex-wrap mb-1 w-full">
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Barang <span className="text-red-600">*</span>
                  </label>

                  <select
                    value={barangPesanan}
                    className="border border-gray-300 w-full rounded-md mb-1"
                    onChange={(e) => setBarangPesanan(e.target.value)}
                  >
                    <option value="">
                      {" "}
                      <p className="mr-3 flex items-center gap-1 text-base">
                        <FaBoxOpen />
                        {selectedBarang == "" ? "Pilih Barang" : selectedBarang}
                      </p>
                    </option>
                    {dataBarang.map((barang, index) => (
                      <option
                        value={barang.id.toString()}
                        onClick={(e) => setSelectedBarang(barang.nama_barang)}
                        key={index}
                      >
                        {barang.nama_barang} - Rp. {barang.harga_jual}
                      </option>
                    ))}
                  </select>
                </div>
              </div>

              <div className="flex flex-wrap mb-1 w-full">
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Kuantitas <span className="text-red-600">*</span>
                  </label>
                  <input
                    id="unit"
                    type="number"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder={"Masukkan kuantitas pemesanan"}
                    required
                    value={kuantitasPemesanan}
                    onChange={(e) => setKuantitasPemesanan(e.target.value)}
                  />
                </div>
              </div>

              <AlertDialogFooter className="mt-3">
                <AlertDialogCancel
                  onClick={(e) => {
                    setIsOpenBarangPesanan(!isOpenBarangPesanan);
                  }}
                >
                  Cancel
                </AlertDialogCancel>
                <AlertDialogAction
                  onClick={(e) => {
                    handleUploadDataBarangPemesanan(e);
                  }}
                >
                  Upload
                </AlertDialogAction>
              </AlertDialogFooter>
            </form>
          </fieldset>
        </AlertDialogContent>
      </AlertDialog>
      {showFormAjukanPelatihan ? (
        <>
          {/* Header Tabel Data Pelatihan */}
          <div className="flex flex-wrap items-center mb-3 justify-between gap-3 sm:flex-nowrap">
            {/* Button Ajukan Permohonan Buka Pelatihan */}
          </div>

          {/* List Data Pelatihan */}
          <div>
            <FormPelatihan edit={false} />
          </div>
        </>
      ) : showCertificateSetting ? (
        <>
          <div className="max-h-[500px] flex flex-col gap-2 overflow-y-auto scroll-smooth"></div>
        </>
      ) : (
        <>
          {/* Header Tabel Data Pelatihan */}
          <div className="flex flex-wrap items-center mb-3 justify-between gap-3 sm:flex-nowrap">
            {/* Statistik Pelatihan */}
            <div className="flex w-full flex-wrap gap-3 sm:gap-5">
              <div className="flex min-w-47.5">
                <span className="mr-2 mt-1 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-primary">
                  <span className="block h-2.5 w-full max-w-2.5 rounded-full bg-primary"></span>
                </span>
                <div className="w-full">
                  <p className="font-semibold text-primary">Total Pemesanan</p>
                  <p className="text-sm font-medium">{data.length} pemesanan</p>
                </div>
              </div>
            </div>
          </div>

          {/* List Data Pelatihan */}
          <div>
            <div id="chartOne" className="-ml-5"></div>
            <div className="flex w-full items-center mb-2">
              <div className="w-full flex justify-end gap-2">
                <div
                  onClick={(e) => {
                    setIsOpenFormMateri(!isOpenFormMateri);
                  }}
                  className="flex gap-2 px-3 text-sm items-center rounded-md bg-whiter p-1.5  cursor-pointer w-fit"
                >
                  <FiUploadCloud />
                  Tambah Data Pemesanan
                </div>
              </div>
            </div>

            <TableData
              isLoading={isFetching}
              columns={columns}
              table={table}
              type={"short"}
            />
            <div className="flex items-center justify-end space-x-2 py-4">
              <div className="text-muted-foreground flex-1 text-sm">
                {table.getFilteredSelectedRowModel().rows.length} of{" "}
                {table.getFilteredRowModel().rows.length} row(s) selected.
              </div>
              <div className="space-x-2">
                <Button
                  variant="outline"
                  size="sm"
                  className="font-inter"
                  onClick={() => table.previousPage()}
                  disabled={!table.getCanPreviousPage()}
                >
                  Previous
                </Button>
                <Button
                  variant="outline"
                  size="sm"
                  className="font-inter"
                  onClick={() => table.nextPage()}
                  disabled={!table.getCanNextPage()}
                >
                  Next
                </Button>
              </div>
            </div>
          </div>
        </>
      )}
    </div>
  );
};

export default TableDataPelatihan;
