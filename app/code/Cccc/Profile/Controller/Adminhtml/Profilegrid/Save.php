<?php
namespace Cccc\Profile\Controller\Adminhtml\Profilegrid;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */

    protected $_file;
    public function __construct(
            \Magento\Backend\App\Action\Context $context, 
            \Magento\Framework\Filesystem\Driver\File $file)
         {

            $this->_file = $file;
            parent::__construct($context);
         }

	public function execute()
    {
		
        $data = $this->getRequest()->getParams();

        //echo '<pre>';print_r($data);die;

        if ($data) {
            $model = $this->_objectManager->create('Cccc\Profile\Model\Profile');
		     
            $pathSunil = 'profile/images';


            if(isset($data['image']['delete']))
            {

                $fileName = $data['image']['value'];

                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                $mediaRootDir = $mediaDirectory->getAbsolutePath();

                if ($this->_file->isExists($mediaRootDir . $fileName))  {

                    $this->_file->deleteFile($mediaRootDir . $fileName);
                }
            }


            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
				try {
					    $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', array('fileId' => 'image'));
						$uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
						$uploader->setAllowRenameFiles(true);
						$uploader->setFilesDispersion(true);
						$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
							->getDirectoryRead(DirectoryList::MEDIA);
						$result = $uploader->save($mediaDirectory->getAbsolutePath('profile/images'));
                        
						unset($result['tmp_name']);
						unset($result['path']);
						$data['image'] = $result['file'];
                        $data['image'] = $pathSunil.$data['image'];
				} catch (Exception $e) {
					$data['image'] = $_FILES['image']['name'];
                    $data['image'] = $pathSunil.$data['image'];
				}
			}
			else{
				$data['image'] = $data['image']['value'];
			}

            

            
            

            //echo '<pre>';print_r($data);die;

			$id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
                $data['updated_date'] =  date("Y-m-d H:i:s");
            }
            else
            {
                $data['created_date'] = date("Y-m-d H:i:s");
            }
			
            $model->setData($data);
			
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Profile Has been Saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId(), '_current' => true));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the profile.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('banner_id' => $this->getRequest()->getParam('banner_id')));
            return;
        }
        $this->_redirect('*/*/');
    }
}
