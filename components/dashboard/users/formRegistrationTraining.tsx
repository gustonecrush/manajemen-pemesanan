"use client";

import Toast from "@/components/toast";
import { Input } from "@/components/ui/input";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { useRouter } from "next/navigation";
import React, { FormEvent } from "react";

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
import Image from "next/image";
import {
  TbBox,
  TbFileStack,
  TbMapPinSearch,
  TbMoneybag,
  TbUserEdit,
} from "react-icons/tb";

import { Progress } from "@/components/ui/progress";
import { MdWorkOutline } from "react-icons/md";
import { Checkbox } from "@/components/ui/checkbox";
import axios, { AxiosResponse } from "axios";
import Cookies from "js-cookie";
import { PelatihanMasyarakat } from "@/types/product";

function FormRegistrationTraining({
  id,
  harga,
  pelatihan,
}: {
  id: number;
  harga: string;
  pelatihan: PelatihanMasyarakat;
}) {
  const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth", // This smooth scrolling is optional, you can remove it if you want instant scrolling
    });
  };

  const [isInputError, setIsInputError] = React.useState(false);

  const baseUrl = process.env.NEXT_PUBLIC_BASE_URL;
  const token = Cookies.get("XSRF081");
  const router = useRouter();

  const [totalBayar, setTotalBayar] = React.useState(0);

  const handleRegistrationTrainingForPeople = async (e: any) => {
    e.preventDefault();
    try {
      const response: AxiosResponse = await axios.post(
        `${baseUrl}/users/addPelatihan`,
        JSON.stringify({
          id_pelatihan: id.toString(),
          totalBayar: harga.toString(),
          namaPelatihan: pelatihan?.NamaPelatihan,
          bidangPelatihan: pelatihan?.BidangPelatihan,
          DetailPelatihan: pelatihan?.DetailPelatihan,
          statusAproval: pelatihan?.StatusApproval,
        }),
        {
          headers: {
            Authorization: `Bearer ${token}`,
            "Content-Type": "application/json",
          },
        }
      );

      Toast.fire({
        icon: "success",
        title: `Berhasil melakukan pendaftaran, tunggu kabar selanjutnya sobat ELAUT!`,
      });
      console.log({ response });
      router.push("/dashboard");
    } catch (error) {
      console.error({ error });
      Toast.fire({
        icon: "error",
        title: "Anda telah mendaftar pelatihan ini sebelumnya!",
      });
    }
  };

  type Sarpras = {
    IdSarpras: number;
    IdLemdik: number;
    NamaSarpras: string;
    Harga: number;
    Deskripsi: string;
    Jenis: string;
    CreatedAt: string;
    UpdatedAt: string;
  };

  const [sarpras, setSarpras] = React.useState<Sarpras[]>([]);
  const [konsumsi, setKonsumsi] = React.useState<Sarpras[]>([]);

  const handleFetchingSarprasData = async () => {
    try {
      const response: AxiosResponse = await axios.get(
        `${baseUrl}/lemdik/getSarpras?jenis_sarpras=Penginapan`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      console.log({ response });
      setSarpras(response.data.data);
    } catch (error) {
      console.error("Error fetching data sarpras:", error);
      throw error;
    }
  };

  const handleFetchingKonsumsiData = async () => {
    try {
      const response: AxiosResponse = await axios.get(
        `${baseUrl}/lemdik/getSarpras?jenis_sarpras=Konsumsi`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      console.log({ response });
      setKonsumsi(response.data.data);
    } catch (error) {
      console.error("Error fetching data konsumsi:", error);
      throw error;
    }
  };

  React.useEffect(() => {
    handleFetchingSarprasData();
    handleFetchingKonsumsiData();
  }, []);

  const [formTab, setFormTab] = React.useState("FormFasilitas");
  const [indexFormTab, setIndexFormTab] = React.useState(0);

  const [isTakeFacilityHome, setIsTakeFacilityHome] = React.useState(false);
  const [isTakeFacilityFood, setIsTakeFacilityFood] = React.useState(false);

  const FormFasilitas = () => {
    return (
      <form
        autoComplete="off"
        className={`${indexFormTab == 0 ? "block" : "hidden"}`}
      >
        <div className="flex flex-wrap -mx-3 mb-1">
          <div className="w-full px-3">
            <label
              className="block text-gray-800 text-sm font-medium mb-1"
              htmlFor="email"
            >
              Pilih Paket Fasilitas Penginapan{" "}
              <span className="text-red-600">*</span>
            </label>
            <div className="flex flex-col gap-2">
              {sarpras.map((item, index) => (
                <div
                  key={index}
                  className="flex flex-row items-start space-x-3 space-y-0 rounded-md border p-4 shadow"
                >
                  <div>
                    <Checkbox />
                  </div>
                  <div className="space-y-1 leading-none">
                    <label>
                      {item.NamaSarpras} Rp. {item.Harga}
                    </label>
                    <p className="text-xs text-gray-600">{item.Deskripsi}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </form>
    );
  };

  const FormPembayaran = () => {
    return (
      <form
        autoComplete="off"
        className={`${indexFormTab == 1 ? "block" : "hidden"}`}
      >
        <div className="flex flex-wrap -mx-3 mb-1">
          <div className="w-full px-3">
            <label
              className="block text-gray-800 text-sm font-medium mb-1"
              htmlFor="email"
            >
              Metode Pembayaran <span className="text-red-600">*</span>
            </label>
            <Select>
              <SelectTrigger className="w-full text-base py-6">
                <SelectValue placeholder="Pilih metode pembayaran" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="Bayar Dengan Transfer">
                  Bayar Dengan Transfer
                </SelectItem>
              </SelectContent>
            </Select>
          </div>
        </div>
        <div className="flex flex-wrap -mx-3 mb-1">
          <div className="w-full px-3">
            {/* <label
              className="block text-gray-800 text-sm font-medium mb-1"
              htmlFor="email"
            >
              Rincian Harga <span className="text-red-600"></span>
            </label>
            <Select>
              <SelectTrigger className="w-full text-base py-16">
                <div className="flex flex-col items-start gap-1">
                  <p className="font-medium font-calsans text-lg text-left">
                    Pelatihan
                  </p>
                  <p className="text-left">
                    Diklat Pembesaran Udang Vaname <br />
                    Lvl. Teknisi
                  </p>
                  <p className="font-medium font-calsans">Rp. 110.000</p>
                </div>
              </SelectTrigger>
            </Select>
            <Select>
              <SelectTrigger className="w-full text-base  py-16 mt-2">
                <div className="flex flex-col items-start gap-1">
                  <p className="font-medium font-calsans text-lg text-left">
                    Penginapan
                  </p>
                  <p className="text-left">
                    Paket BAHARI RESIDANCE-UMUM <br />B Rp 110.000
                  </p>
                  <p className="font-medium font-calsans">Rp. 300.000</p>
                </div>
              </SelectTrigger>
            </Select>
            <Select>
              <SelectTrigger className="w-full text-base py-16 mt-2">
                <div className="flex flex-col items-start gap-1">
                  <p className="font-medium font-calsans text-lg text-left">
                    Konsumsi
                  </p>
                  <p className="text-left">
                    Tipe Paket Fullboard, Paket 3x
                    <br /> Makan & Snack
                  </p>
                  <p className="font-medium font-calsans">Rp. 850.000</p>
                </div>
              </SelectTrigger>
            </Select> */}
            <div className="h-1 w-full rounded-full my-2 bg-blue-500"></div>
            <div className="flex items-center justify-between">
              <p className="font-bold text-lg">Total</p>
              <p className="font-bold text-blue-500 text-3xl">Rp. {harga}</p>
            </div>
            <div className="flex items-center space-x-2 py-3 mt-5">
              <Checkbox id="terms" />
              <label
                htmlFor="terms"
                className="text-base  peer-disabled:cursor-not-allowed text-gray-500 peer-disabled:opacity-70"
              >
                Dengan melakukan pendaftaran, saya setuju dengan Kebijakan{" "}
                <span className="text-blue-500 font-bold">Privasi</span> dan{" "}
                <span className="text-blue-500 font-bold">
                  Syarat & Ketentuan
                </span>{" "}
                Kementrian Kelautan dan Perikanan Republik Indonesia
              </label>
            </div>
          </div>
        </div>
      </form>
    );
  };

  return (
    <section className="relative w-full -mt-5">
      <div className="max-w-6xl md:max-w-[81rem]  md:-mt-8">
        <div className="pb-12 md:pb-20">
          {/* Form */}
          <div className="max-w-sm md:max-w-7xl mx-auto mt-5 md:mt-10">
            <div className="flex items-center justify-between">
              {indexFormTab == 0 ? (
                <h2 className="font-bold text-2xl md:text-3xl leading-[100%] my-6 text-black font-calsans flex items-center gap-1">
                  <TbBox />
                  <span className="mt-2">Pilih Fasilitas</span>
                </h2>
              ) : (
                <h2 className="font-bold text-2xl leading-[100%] my-6 md:text-2xl text-black font-calsans flex items-center gap-1">
                  <TbMoneybag />
                  <span className="mt-2">Pembayaran</span>
                </h2>
              )}

              <p className="text-base">
                {indexFormTab == 0 ? (
                  <span className="font-bold  leading-[100%] my-6 text-blue-500 ">
                    1
                  </span>
                ) : (
                  <span className="font-bold  leading-[100%] my-6 text-blue-500 ">
                    2
                  </span>
                )}{" "}
                of 2
              </p>
            </div>
            <div className="flex w-full -mt-2 mb-4">
              <Progress value={(indexFormTab + 1) * 50} max={2} />
            </div>
            <FormFasilitas />
            <FormPembayaran />
            <div className="flex -mx-3 mt-5 gap-2 px-3">
              <div className={`w-full ${indexFormTab == 0 && "hidden"}`}>
                <button
                  type="submit"
                  className="btn text-white bg-blue-600 hover:bg-blue-700 w-full"
                  onClick={(e) => {
                    setIndexFormTab(indexFormTab - 1);
                    scrollToTop();
                  }}
                >
                  Sebelumnya
                </button>
              </div>
              <div
                className={`w-full ${indexFormTab == 1 ? "hidden" : "block"}`}
              >
                <button
                  type="submit"
                  className="btn text-white bg-blue-600 hover:bg-blue-700 w-full"
                  onClick={(e) => {
                    setIndexFormTab(indexFormTab + 1);
                    scrollToTop();
                  }}
                >
                  Selanjutnya
                </button>
              </div>
              <AlertDialog>
                <AlertDialogTrigger asChild>
                  <div
                    className={`w-full ${
                      indexFormTab == 1 ? "block" : "hidden"
                    }`}
                  >
                    <button
                      onClick={(e) => handleRegistrationTrainingForPeople(e)}
                      type="submit"
                      className="btn text-white bg-blue-600 hover:bg-blue-700 w-full"
                    >
                      Daftar
                    </button>
                  </div>
                </AlertDialogTrigger>
                <AlertDialogContent className="rounded-lg">
                  <AlertDialogHeader className="flex items-center">
                    <AlertDialogTitle className="text-2xl leading-8">
                      Berhasil Melakukan Registrasi
                    </AlertDialogTitle>
                    <Image
                      className="w-[40%] py-4 animate-float"
                      src={"/illustrations/approved.png"}
                      width={0}
                      height={0}
                      alt="Apakah anda yakin?"
                    />
                    <AlertDialogDescription className="text-base leading-[130%]">
                      Nantikan informasi lebih lanjut terkait pelatihan ini,
                      operator akan menghubungi anda melalui whatsapp!
                    </AlertDialogDescription>
                  </AlertDialogHeader>
                  <AlertDialogFooter>
                    <AlertDialogCancel className=" py-6 text-base">
                      Oke
                    </AlertDialogCancel>
                  </AlertDialogFooter>
                </AlertDialogContent>
              </AlertDialog>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

export default FormRegistrationTraining;
