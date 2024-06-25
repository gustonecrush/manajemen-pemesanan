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
import { FaBookOpen, FaBoxOpen, FaRupiahSign } from "react-icons/fa6";
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

const TableDataBarang: React.FC = () => {
  const [showFormAjukanPelatihan, setShowFormAjukanPelatihan] =
    React.useState<boolean>(false);
  const [showCertificateSetting, setShowCertificateSetting] =
    React.useState<boolean>(false);

  const baseUrl = process.env.NEXT_PUBLIC_BASE_URL;

  const [isFetching, setIsFetching] = React.useState<boolean>(false);

  const [data, setData] = React.useState<Barang[]>([]);
  const handleFetchingDataBarang = async () => {
    try {
      const response: AxiosResponse = await axios.get(`${baseUrl}/api/barangs`);
      setData(response.data);
      console.log("FETCHCING DATA BARANG : ", response);
    } catch (error) {
      console.error("ERROR FETCHING DATA BARANG : ", error);
      throw error;
    }
  };

  const [namaBarang, setNamaBarang] = React.useState<string>("");
  const [kodeBarang, setKodeBarang] = React.useState<string>("");
  const [hargaJual, setHargaJual] = React.useState<string>("");
  const [stokBarang, setStokBarang] = React.useState<string>("");

  const handleUploadDataBarang = async (e: any) => {
    const userId = Cookies.get("XSRF098888");

    const data = new FormData();
    data.append("nama_barang", namaBarang);
    data.append("kode_barang", kodeBarang);
    data.append("harga_jual", hargaJual);
    data.append("stok_barang", stokBarang);

    try {
      const response = await axios.post(`${baseUrl}/api/barangs`, data);
      console.log("UPLOAD DATA BARANG : ", response);
      Toast.fire({
        icon: "success",
        title: `Sukses menambahkan data barang!`,
      });
      setIsOpenFormMateri(!isOpenFormMateri);
      handleFetchingDataBarang();
    } catch (error) {
      console.error("ERROR UPLOAD DATA BARANG : ", error);
      Toast.fire({
        icon: "error",
        title: `Gagal menambahkan data barang, harap coba lagi nanti!`,
      });
      setIsOpenFormMateri(!isOpenFormMateri);
      handleFetchingDataBarang();
      throw error;
    }
  };

  const handleDeleteDataBarang = async (e: any, id: number) => {
    e.preventDefault();

    try {
      const response = await axios.delete(`${baseUrl}/api/barangs/${id}`);
      console.log("DELETE DATA PEMESANAN : ", response);
      Toast.fire({
        icon: "success",
        title: `Sukses menghapus data pemesanan!`,
      });
      handleFetchingDataBarang();
    } catch (error) {
      console.error("ERROR DELETE DATA PEMESANAN : ", error);
      Toast.fire({
        icon: "error",
        title: `Gagal menghapus data pemesanan, harap coba lagi nanti!`,
      });
      handleFetchingDataBarang();
      throw error;
    }
  };

  const [idSelectedBarangUpdate, setIdSelectedBarangUpdate] =
    React.useState<number>(0);
  const [isUpdate, setIsUpdate] = React.useState<boolean>(false);
  const handleOpenFormUpdateBarang = async (e: any, id: number) => {
    e.preventDefault();
    setIdSelectedBarangUpdate(id);
    setIsUpdate(!isUpdate);
    try {
      const response: AxiosResponse = await axios.get(
        `${baseUrl}/api/barangs/${id}`
      );
      setNamaBarang(response.data.nama_barang);
      setStokBarang(response.data.stok_barang);
      setKodeBarang(response.data.kode_barang);
      setHargaJual(response.data.harga_jual);
      setIsOpenFormMateri(!isOpenFormMateri);
    } catch (error) {
      console.error("ERROR GET BY ID BARANG : ", error);
      Toast.fire({
        icon: "error",
        title: `Data tidak ditemukan!`,
      });
      setIsUpdate(false);
    }
  };

  const handleUpdateDataBarang = async (e: any) => {
    const userId = Cookies.get("XSRF098888");

    const data = new FormData();
    data.append("nama_barang", namaBarang);
    data.append("kode_barang", kodeBarang);
    data.append("harga_jual", hargaJual);
    data.append("stok_barang", stokBarang);

    try {
      const response = await axios.post(
        `${baseUrl}/api/barangs/${idSelectedBarangUpdate}`,
        data
      );
      console.log("UPDATE DATA BARANG : ", response);
      Toast.fire({
        icon: "success",
        title: `Sukses mengupdate data barang!`,
      });
      setIsOpenFormMateri(!isOpenFormMateri);
      handleFetchingDataBarang();
      setIsUpdate(false);
      setNamaBarang("");
      setKodeBarang("");
      setStokBarang("");
      setHargaJual("");
      setIdSelectedBarangUpdate(0);
    } catch (error) {
      console.error("ERROR UPLOAD DATA BARANG : ", error);
      Toast.fire({
        icon: "error",
        title: `Gagal megupdate data barang, harap coba lagi nanti!`,
      });
      setIsOpenFormMateri(!isOpenFormMateri);
      handleFetchingDataBarang();
      setIsUpdate(false);
      setNamaBarang("");
      setKodeBarang("");
      setStokBarang("");
      setHargaJual("");
      setIdSelectedBarangUpdate(0);
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
  const columns: ColumnDef<Barang>[] = [
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
      accessorKey: "kode_barang",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            className={`w-fit ml-2 text-gray-900 font-semibold`}
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
              onClick={(e) => handleOpenFormUpdateBarang(e, row.original.id)}
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
                    Apakah kamu yakin menghapus data barang ini?
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
                    onClick={(e) => handleDeleteDataBarang(e, row.original.id)}
                    className="bg-rose-600"
                  >
                    Hapus
                  </AlertDialogAction>
                </AlertDialogFooter>
              </AlertDialogContent>
            </AlertDialog>
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
            Barang
            <TbShoppingCart className="ml-1 h-4 w-4" />
          </Button>
        );
      },
      cell: ({ row }) => (
        <div className={`text-left capitalize`}>
          <p className="text-base font-semibold tracking-tight leading-none">
            {row.original.nama_barang}
          </p>

          <p className="text-xs text-gray-400 mt-1 leading-[100%] mb-1">
            {row.original.kode_barang}
          </p>
        </div>
      ),
    },
    {
      accessorKey: "stok_barang",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            className={`p-0 !text-left w-[270px] flex items-center justify-start text-gray-900 font-semibold`}
            onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
          >
            Stok & Harga
            <IoLogoDropbox className="ml-1 h-4 w-4" />
          </Button>
        );
      },
      cell: ({ row }) => (
        <div className={`text-left`}>
          <p className="text-base font-semibold tracking-tight leading-none">
            {row.original.stok_barang} Stok
          </p>

          <p className="text-xs text-gray-400 mt-1 leading-[100%] mb-1">
            Dengan harga Rp. {row.original.harga_jual}/item
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
    handleFetchingDataBarang();
  }, []);

  return (
    <div className="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default  sm:px-7.5 xl:col-span-8">
      <AlertDialog open={isOpenFormMateri}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle className="flex items-center gap-2">
              {" "}
              <TbShoppingCart className="h-4 w-4" />
              {isUpdate ? "Update Data Barang" : "Tambah Data Barang"}
            </AlertDialogTitle>
            <AlertDialogDescription className="-mt-10">
              {isUpdate ? "Update" : "Tambahkan"} data barang-mu segera sekarang
              agar terlist riwayat pemesanan yang masuk ke CV!
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
                  <input
                    id="pemesanan"
                    type="text"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder={isUpdate ? namaBarang : "Masukkan nama barang"}
                    required
                    value={namaBarang}
                    onChange={(e) => setNamaBarang(e.target.value)}
                  />
                </div>
              </div>

              <div className="flex mb-1 gap-2 w-full">
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Kode Barang <span className="text-red-600">*</span>
                  </label>
                  <input
                    id="kode_barang"
                    type="text"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder={isUpdate ? kodeBarang : "Masukkan kode barang"}
                    required
                    value={kodeBarang}
                    onChange={(e) => setKodeBarang(e.target.value)}
                  />
                </div>
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Harga Jual <span className="text-red-600">*</span>
                  </label>
                  <input
                    id="pemesan"
                    type="text"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder={isUpdate ? hargaJual : "Masukkan harga jual"}
                    required
                    value={hargaJual}
                    onChange={(e) => setHargaJual(e.target.value)}
                  />
                </div>
              </div>

              <div className="flex flex-wrap mb-1 w-full">
                <div className="w-full">
                  <label
                    className="block text-gray-800 text-sm font-medium mb-1"
                    htmlFor="name"
                  >
                    Stok <span className="text-red-600">*</span>
                  </label>
                  <input
                    id="unit"
                    type="number"
                    className="form-input w-full text-black border-gray-300 rounded-md"
                    placeholder={
                      isUpdate ? stokBarang.toString() : "Masukkan stok"
                    }
                    required
                    value={stokBarang}
                    onChange={(e) => setStokBarang(e.target.value)}
                  />
                </div>
              </div>

              <AlertDialogFooter className="mt-3">
                <AlertDialogCancel
                  onClick={(e) => {
                    if (isUpdate) {
                      setIsUpdate(!isUpdate);
                      setNamaBarang("");
                      setKodeBarang("");
                      setStokBarang("");
                      setHargaJual("");
                      setIdSelectedBarangUpdate(0);
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
                      ? handleUpdateDataBarang(e)
                      : handleUploadDataBarang(e);
                  }}
                >
                  {isUpdate ? "Update" : "Upload"}
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
                  <p className="font-semibold text-primary">Total Barang</p>
                  <p className="text-sm font-medium">{data.length} barang</p>
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
                  Tambah Data Barang
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

export default TableDataBarang;
