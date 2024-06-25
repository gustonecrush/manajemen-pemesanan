import Barang from "@/components/dashboard/Dashboard/Barang";
import ECommerce from "@/components/dashboard/Dashboard/E-commerce";
import DefaultLayout from "@/components/dashboard/Layouts/DefaultLayout";
import { Metadata } from "next";

export const metadata: Metadata = {
  title: "Data Barang - Sistem Manajemen Pemesanan Fajar Teknika",
};

export default function Home() {
  return (
    <>
      <DefaultLayout>
        <Barang />
      </DefaultLayout>
    </>
  );
}
