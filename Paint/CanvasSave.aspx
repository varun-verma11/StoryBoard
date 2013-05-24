using System;
using System.IO;
using System.Web.Script.Services;
using System.Web.Services;
 
[ScriptService]
public partial class _Default : System.Web.UI.Page
{
    static string path = @"F:\Dinesh\";
 
    [WebMethod()]
    public static void UploadImage(string imageData)
    {
        string fileNameWitPath = path + DateTime.Now.ToString().Replace("/", "-").Replace(" ", "- ").Replace(":", "") + ".png";
        using (FileStream fs = new FileStream(fileNameWitPath, FileMode.Create))
        {
            using (BinaryWriter bw = new BinaryWriter(fs))
            {
                byte[] data = Convert.FromBase64String(imageData);
                bw.Write(data);
                bw.Close();
 
            }
        }
    }
}
